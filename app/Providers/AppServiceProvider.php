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
        // Fetch holidays from DB (Cached for 24 hours to prevent querying on every request)
        $holidays = Cache::remember('indonesian_holidays', 86400, function () {
            try {
                if (Schema::hasTable('holidays')) {
                    return Holiday::pluck('date')->map(function($date) {
                        return $date->format('Y-m-d');
                    })->toArray();
                }
            } catch (\Exception $e) {
                // If DB is not ready during tests/migrations
            }
            return [];
        });

        Carbon::macro('isHoliday', function() use ($holidays) {
            return in_array($this->format('Y-m-d'), $holidays);
        });

        Carbon::macro('addWorkingDaysWithHolidays', function($days) {
            $date = $this->copy();
            $added = 0;
            // Jika hari ini libur, jangan skip hari ini. Tapi kalau besok libur, baru di-skip.
            while ($added < $days) {
                $date->addDay();
                if (!$date->isWeekend() && !$date->isHoliday()) {
                    $added++;
                }
            }
            return $date;
        });

        Carbon::macro('diffInWorkingDaysWithHolidays', function($target) {
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
                if (!$start->isWeekend() && !$start->isHoliday()) {
                    $days++;
                }
            }
            
            return $isNegative ? -$days : $days;
        });
    }
}
