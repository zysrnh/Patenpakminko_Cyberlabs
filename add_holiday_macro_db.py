import os
import re

# 1. Update AppServiceProvider
provider_path = r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\app\Providers\AppServiceProvider.php'

provider_content = """<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\Holiday;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

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
"""

with open(provider_path, 'w', encoding='utf-8') as f:
    f.write(provider_content)
print("Updated AppServiceProvider with DB Holidays Macro")


# 2. Update the blade files
files = [
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\berusaha\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\non-berusaha\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\kebijakan\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\tanah-timbul\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\psn\show.blade.php'
]

new_sla_logic = r'''
                    @php
                        $isPuOrPtsp = Auth::user()->isDinasPu() || Auth::user()->isSatuPintu();
                        $defaultDays = $isPuOrPtsp ? 20 : 10;
                        
                        // Menghitung target SLA dengan skip hari libur nasional dan weekend
                        $targetDate = $application->tgl_selesai_layanan 
                            ? \Carbon\Carbon::parse($application->tgl_selesai_layanan) 
                            : $application->created_at->addWorkingDaysWithHolidays($defaultDays);
                        
                        $isSelesai = false;
                        if (Auth::user()->isBpn()) {
                            $isSelesai = ($application->bpn_pertek_document || in_array($application->status, ['ditolak', 'menunggu_dinas_pu', 'menunggu_satu_pintu', 'disetujui']));
                        } elseif (Auth::user()->isDinasPu()) {
                            $isSelesai = ($application->dinas_pu_status === 'disetujui' || in_array($application->status, ['ditolak', 'menunggu_satu_pintu', 'disetujui']));
                        } else {
                            $isSelesai = in_array($application->status, ['ditolak', 'disetujui']);
                        }
                        
                        if ($isSelesai) {
                            $slaBg = '#16A34A'; // Solid Green
                            $slaBorder = '#15803D';
                            $slaColor = '#FFFFFF';
                        } else {
                            $now = \Carbon\Carbon::now();
                            // Menggunakan macro baru yang skip tanggal merah & weekend
                            $daysRemaining = $now->diffInWorkingDaysWithHolidays($targetDate);
                            
                            if ($isPuOrPtsp) {
                                if ($daysRemaining >= 4) {
                                    $slaBg = '#16A34A'; 
                                    $slaBorder = '#15803D';
                                    $slaColor = '#FFFFFF';
                                } elseif ($daysRemaining >= 1) {
                                    $slaBg = '#EAB308'; 
                                    $slaBorder = '#CA8A04';
                                    $slaColor = '#FFFFFF';
                                } else {
                                    $slaBg = '#DC2626'; 
                                    $slaBorder = '#B91C1C';
                                    $slaColor = '#FFFFFF';
                                }
                            } else {
                                if ($daysRemaining >= 3) {
                                    $slaBg = '#16A34A'; 
                                    $slaBorder = '#15803D';
                                    $slaColor = '#FFFFFF';
                                } elseif ($daysRemaining >= 1) {
                                    $slaBg = '#EAB308'; 
                                    $slaBorder = '#CA8A04';
                                    $slaColor = '#FFFFFF';
                                } else {
                                    $slaBg = '#DC2626'; 
                                    $slaBorder = '#B91C1C';
                                    $slaColor = '#FFFFFF';
                                }
                            }
                        }
                    @endphp
'''

for file in files:
    if os.path.exists(file):
        with open(file, 'r', encoding='utf-8') as f:
            content = f.read()
            
        pattern = r'@php\s+\$targetDate = .*?\$slaColor = \'#FFFFFF\';\s+\}\s+\}\s+@endphp'
        
        # Use lambda to avoid regex escape sequence issues
        content = re.sub(pattern, lambda m: new_sla_logic.strip(), content, flags=re.DOTALL)
        
        with open(file, 'w', encoding='utf-8') as f:
            f.write(content)
        print('Updated Blade SLA logic in ' + file)
