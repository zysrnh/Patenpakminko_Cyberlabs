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
        $getHolidays = function () {
            return Cache::remember('indonesian_holidays', 3600, function () {
                $nationalHolidays = [];
                try {
                    $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                        ->timeout(3)
                        ->get('https://api-harilibur.vercel.app/api');
                    if ($response->successful()) {
                        foreach ($response->json() as $holiday) {
                            if (isset($holiday['holiday_date']) && (!isset($holiday['is_national_holiday']) || $holiday['is_national_holiday'])) {
                                $nationalHolidays[] = $holiday['holiday_date'];
                            }
                        }
                    }
                } catch (\Throwable $e) {}

                $dbHolidays = [];
                try {
                    if (Schema::hasTable('holidays')) {
                        $dbHolidays = Holiday::pluck('date')->map(function($date) {
                            return \Carbon\Carbon::parse($date)->format('Y-m-d');
                        })->toArray();
                    }
                } catch (\Throwable $e) {}

                return array_values(array_unique(array_merge($nationalHolidays, $dbHolidays)));
            });
        };

        Carbon::macro('isHoliday', function() use ($getHolidays) {
            $holidays = $getHolidays();
            return in_array($this->format('Y-m-d'), $holidays);
        });

        Carbon::macro('isWorkingDay', function() use ($getHolidays) {
            $holidays = $getHolidays();
            // Hari kerja: Bukan Sabtu (6), Bukan Minggu (0), dan bukan Tanggal Merah/Cuti Bersama
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
