<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\Holiday;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        // Fetch holidays from API and DB (Cached for 24 hours)
        $holidays = Cache::remember('indonesian_holidays', 86400, function () {
            $nationalHolidays = [];
            
            // 1. Fetch dari API Libur Nasional
            try {
                $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                    ->timeout(5)
                    ->get('https://api-harilibur.vercel.app/api');
                
                if ($response->successful()) {
                    foreach ($response->json() as $holiday) {
                        if (isset($holiday['holiday_date']) && (isset($holiday['is_national_holiday']) && $holiday['is_national_holiday'])) {
                            $nationalHolidays[] = $holiday['holiday_date'];
                        }
                    }
                }
            } catch (\Exception $e) {
                // Ignore API failure
            }

            // 2. Fetch dari Kalender DB Lokal (Libur Tambahan)
            try {
                if (Schema::hasTable('holidays')) {
                    $dbHolidays = Holiday::pluck('date')->map(function($date) {
                        return $date->format('Y-m-d');
                    })->toArray();
                    
                    return array_unique(array_merge($nationalHolidays, $dbHolidays));
                }
            } catch (\Exception $e) {
                // If DB is not ready during tests/migrations
            }
            
            return $nationalHolidays;
        });

        Carbon::macro('isHoliday', function() use ($holidays) {
            return in_array($this->format('Y-m-d'), $holidays);
        });

        Carbon::macro('isWorkingDay', function() use ($holidays) {
            return !$this->isWeekend() && !in_array($this->format('Y-m-d'), $holidays);
        });

        Carbon::macro('addWorkingDaysWithHolidays', function($days) {
            $date = $this->copy()->startOfDay();
            while (!$date->isWorkingDay()) {
                $date->addDay();
            }
            $added = 1;
            while ($added < $days) {
                $date->addDay();
                if ($date->isWorkingDay()) {
                    $added++;
                }
            }
            return $date;
        });

        Carbon::macro('getEffectiveWorkingDayNumber', function($target = null) {
            $target = $target ? ($target instanceof \DateTimeInterface ? Carbon::instance($target) : Carbon::parse($target)) : Carbon::now();
            
            $start = $this->copy()->startOfDay();
            $end = $target->copy()->startOfDay();
            
            while (!$start->isWorkingDay()) {
                $start->addDay();
            }
            
            if ($end < $start) {
                return 0;
            }
            
            $count = 0;
            $curr = $start->copy();
            while ($curr <= $end) {
                if ($curr->isWorkingDay()) {
                    $count++;
                }
                $curr->addDay();
            }
            
            return $count;
        });

        Carbon::macro('diffInWorkingDaysWithHolidays', function($target) {
            if (!$target) {
                return 0;
            }
            if (!$target instanceof \DateTimeInterface) {
                try {
                    $target = \Carbon\Carbon::parse($target);
                } catch (\Exception $e) {
                    return 0;
                }
            }
            $start = $this->copy()->startOfDay();
            $end = $target->copy()->startOfDay();
            
            if ($start > $end) {
                $temp = $start->copy();
                $start = $end->copy();
                $end = $temp;
                $isNegative = true;
            } else {
                $isNegative = false;
            }
            
            $days = 0;
            while ($start < $end) {
                $start->addDay();
                if ($start->isWorkingDay()) {
                    $days++;
                }
            }
            
            return $isNegative ? -$days : $days;
        });
    }
}
