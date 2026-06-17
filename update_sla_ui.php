<?php

$files = [
    'resources/views/berusaha/show.blade.php',
    'resources/views/non-berusaha/show.blade.php',
    'resources/views/psn/show.blade.php',
    'resources/views/kebijakan/show.blade.php',
    'resources/views/tanah-timbul/show.blade.php',
];

$replacement = <<<'HTML'
<!-- DAY COUNTER / SLA BANNER -->
                    @php
                        $targetDate = $application->created_at->addWeekdays(10);
                        $isSelesai = ($application->bpn_pertek_document || in_array($application->status, ['ditolak', 'menunggu_dinas_pu', 'menunggu_satu_pintu', 'disetujui']));
                        
                        if ($isSelesai) {
                            $slaBg = '#16A34A'; // Solid Green
                            $slaBorder = '#15803D';
                            $slaColor = '#FFFFFF';
                        } else {
                            $now = \Carbon\Carbon::now();
                            if ($targetDate->startOfDay() >= $now->startOfDay()) {
                                $daysRemaining = $now->startOfDay()->diffInWeekdays($targetDate->startOfDay());
                            } else {
                                $daysRemaining = -1 * $targetDate->startOfDay()->diffInWeekdays($now->startOfDay());
                            }
                            
                            if ($daysRemaining >= 4) {
                                $slaBg = '#16A34A'; // Solid Green
                                $slaBorder = '#15803D';
                                $slaColor = '#FFFFFF';
                            } elseif ($daysRemaining >= 0) {
                                $slaBg = '#EAB308'; // Solid Yellow
                                $slaBorder = '#CA8A04';
                                $slaColor = '#FFFFFF';
                            } else {
                                $slaBg = '#DC2626'; // Solid Red
                                $slaBorder = '#B91C1C';
                                $slaColor = '#FFFFFF';
                            }
                        }
                    @endphp
                    
                    <div class="floating-sla" style="position: fixed; top: 120px; right: 32px; z-index: 9999; background: {{ $slaBg }}; border-radius: var(--r-md); box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: 1px solid {{ $slaBorder }}; width: 260px; overflow: hidden; display: flex; flex-direction: column;">
                        <div style="padding: 10px 14px; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <div style="font-size: 10px; font-weight: 800; color: {{ $slaColor }}; opacity: 0.95; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.05em;">Batas Waktu (SLA)</div>
                            <div style="font-size: 12.5px; color: {{ $slaColor }};">Target: <strong style="font-weight: 800;">{{ $targetDate->format('d M Y') }}</strong></div>
                        </div>
                        <div style="padding: 12px 14px; background: rgba(0,0,0,0.06);">
                            @if($isSelesai)
                                <div style="display: flex; align-items: center; gap: 8px; color: {{ $slaColor }}; font-weight: 700; font-size: 13px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(255,255,255,0.25); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span>Tepat Waktu (Selesai)</span>
                                </div>
                            @else
                                <div style="font-size: 10px; color: {{ $slaColor }}; opacity: 0.95; margin-bottom: 8px; font-weight: 700;">WAKTU TERSISA:</div>
                                <div id="liveCountdownSla" data-target="{{ $targetDate->toIso8601String() }}" data-color="{{ $slaColor }}" style="display: flex; gap: 6px; align-items: center; justify-content: space-between;">
                                    <!-- Countdown script will inject here -->
                                </div>
                            @endif
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const targetEl = document.getElementById('liveCountdownSla');
                            if(!targetEl) return;
                            
                            const targetDate = new Date(targetEl.getAttribute('data-target')).getTime();
                            const textColor = targetEl.getAttribute('data-color');
                            
                            function updateCountdown() {
                                const now = new Date().getTime();
                                const distance = targetDate - now;
                                
                                if (distance < 0) {
                                    targetEl.innerHTML = '<div style="color: ' + textColor + '; font-weight: 800; font-size: 13px; display: flex; align-items: center; gap: 8px;"><svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Waktu Habis!</div>';
                                    return;
                                }
                                
                                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                
                                const blockStyle = 'background: rgba(255,255,255,0.2); padding: 6px 2px; border-radius: 6px; text-align: center; flex: 1; border: 1px solid rgba(255,255,255,0.1);';
                                const numStyle = 'font-size: 14.5px; font-weight: 800; color: ' + textColor + '; font-family: monospace; line-height: 1; margin-bottom: 2px;';
                                const labelStyle = 'font-size: 8.5px; font-weight: 700; color: ' + textColor + '; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em;';
                                
                                targetEl.innerHTML = `
                                    <div style="${blockStyle}"><div style="${numStyle}">${days}</div><div style="${labelStyle}">HARI</div></div>
                                    <div style="font-weight: 800; color: ${textColor}; opacity: 0.5; padding-bottom: 12px;">:</div>
                                    <div style="${blockStyle}"><div style="${numStyle}">${hours.toString().padStart(2, '0')}</div><div style="${labelStyle}">JAM</div></div>
                                    <div style="font-weight: 800; color: ${textColor}; opacity: 0.5; padding-bottom: 12px;">:</div>
                                    <div style="${blockStyle}"><div style="${numStyle}">${minutes.toString().padStart(2, '0')}</div><div style="${labelStyle}">MNT</div></div>
                                    <div style="font-weight: 800; color: ${textColor}; opacity: 0.5; padding-bottom: 12px;">:</div>
                                    <div style="${blockStyle}"><div style="${numStyle}">${seconds.toString().padStart(2, '0')}</div><div style="${labelStyle}">DTK</div></div>
                                `;
                            }
                            
                            updateCountdown();
                            setInterval(updateCountdown, 1000);
                        });
                    </script>
HTML;

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    
    // Find the start and end of the block to replace
    $startStr = '<!-- DAY COUNTER / SLA BANNER -->';
    $endStr = '</script>';
    
    $startPos = strpos($content, $startStr);
    if ($startPos !== false) {
        $endPos = strpos($content, $endStr, $startPos);
        if ($endPos !== false) {
            $endPos += strlen($endStr);
            $newContent = substr($content, 0, $startPos) . $replacement . substr($content, $endPos);
            file_put_contents($file, $newContent);
            echo "Updated UI in $file\n";
        }
    }
}
