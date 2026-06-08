import re

with open('resources/views/berusaha/show.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Remove @if($user->isBpn() && $application->status === 'menunggu_bpn') wrapping the BPN panels
content = re.sub(r"@if\(\$user->isBpn\(\) && \$application->status === 'menunggu_bpn'\)\s*<div class=\"verify-card\">\s*<h3 class=\"verify-title\">🏢 Panel Pemeriksaan BPN</h3>", "", content)

# Remove the closing </div> @endif for that block (which is right before <!-- Success / Error Messages -->)
content = re.sub(r"</div>\s*@endif\s*<!-- Success / Error Messages -->", "<!-- Success / Error Messages -->", content)

# 2. Add Auth::user()->isBpn() to isStepActive definitions for BPN panels
content = content.replace(
    "@php $isStep1Active = ($application->bpn_berkas_status === 'menunggu'); @endphp",
    "@php $isStep1Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'menunggu'); @endphp"
)
content = content.replace(
    "@php $isStep2Active = ($application->dinas_pu_status === 'validasi_awal_diterima' && $application->bpn_pembayaran_status === 'belum_bayar'); @endphp",
    "@php $isStep2Active = (Auth::user()->isBpn() && $application->dinas_pu_status === 'validasi_awal_diterima' && $application->bpn_pembayaran_status === 'belum_bayar'); @endphp"
)
content = content.replace(
    "@php $isStep3Active = ($application->bpn_pembayaran_status === 'sudah_bayar'); @endphp",
    "@php $isStep3Active = (Auth::user()->isBpn() && $application->bpn_pembayaran_status === 'sudah_bayar'); @endphp"
)
content = content.replace(
    "@php $isStep4Active = ($application->bpn_cek_lokasi_dt && true); @endphp",
    "@php $isStep4Active = (Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt && !$application->bpn_rapat_dt); @endphp"
)
content = content.replace(
    "@php $isStep5Active = ($application->bpn_rapat_dt && !$application->bpn_pertek_document); @endphp",
    "@php $isStep5Active = (Auth::user()->isBpn() && $application->bpn_rapat_dt && !$application->bpn_pertek_document); @endphp"
)

# 3. Modify Timeline to add onclick for PU and PTSP
# Step 3: Validasi Permohonan (Dinas PUTR)
content = re.sub(r'<div class="timeline-step \{\{ \$step3Status \}\}">\s*<span class="timeline-dot"></span>\s*<div class="timeline-title">2\. Validasi Permohonan \(Dinas PUTR\)</div>', 
                 '<div class="timeline-step {{ $step3Status }}" onclick="showBpnPanel(\'pu-1\')" style="cursor:pointer;">\n                                <span class="timeline-dot"></span>\n                                <div class="timeline-title">2. Validasi Permohonan (Dinas PUTR)</div>', 
                 content)

# Step 8: Penilaian PKKPR (Dinas PU) -> panel-pu-2
content = re.sub(r'<div class="timeline-step \{\{ \$step8Status \}\}">\s*<span class="timeline-dot"></span>\s*<div class="timeline-title">7\. Penilaian PKKPR \(Dinas PU\)</div>', 
                 '<div class="timeline-step {{ $step8Status }}" onclick="showBpnPanel(\'pu-2\')" style="cursor:pointer;">\n                                <span class="timeline-dot"></span>\n                                <div class="timeline-title">7. Penilaian PKKPR (Dinas PU)</div>', 
                 content)

# Step 9: Penerbitan PKKPR (Satu Pintu / PTSP) -> panel-satu-pintu
content = re.sub(r'<div class="timeline-step \{\{ \$step9Status \}\}">\s*<span class="timeline-dot"></span>\s*<div class="timeline-title">8\. Penerbitan PKKPR \(Satu Pintu / PTSP\)</div>', 
                 '<div class="timeline-step {{ $step9Status }}" onclick="showBpnPanel(\'satu-pintu\')" style="cursor:pointer;">\n                                <span class="timeline-dot"></span>\n                                <div class="timeline-title">8. Penerbitan PKKPR (Satu Pintu / PTSP)</div>', 
                 content)


with open('resources/views/berusaha/show.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Done berusaha refactor")
