import re

for module in ['tanah-timbul', 'kebijakan']:
    with open(f'resources/views/{module}/show.blade.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Remove @if($canVerify) and @if($user->isBpn() && ...) wrapping
    start_verify = "@if($canVerify)\n                <div class=\"verify-card\">\n                    <h3 class=\"verify-title\">📝 Panel Pemeriksaan Berkas — {{ $verifierRoleLabel }}</h3>\n                    \n                    @if($user->isBpn() && $application->status === 'menunggu_bpn')"

    new_verify = """                <div class="verify-card">
                    <h3 class="verify-title">📝 Panel Pemeriksaan Berkas</h3>"""

    content = content.replace(start_verify, new_verify)

    # 2. Add Auth::user()->isBpn() to isStepActive definitions for BPN panels
    content = content.replace(
        "@php $isStep1Active = ($application->bpn_berkas_status === 'menunggu'); @endphp",
        "@php $isStep1Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'menunggu'); @endphp"
    )
    content = content.replace(
        "@php $isStep2Active = ($application->bpn_berkas_status === 'diterima'); @endphp",
        "@php $isStep2Active = (Auth::user()->isBpn() && $application->bpn_berkas_status === 'diterima' && (!$application->bpn_cek_lokasi_dt || !$cekLokasiLewat)); @endphp"
    )
    content = content.replace(
        "@php $isStep3Active = ($application->bpn_cek_lokasi_dt && $cekLokasiLewat); @endphp",
        "@php $isStep3Active = (Auth::user()->isBpn() && $application->bpn_cek_lokasi_dt && $cekLokasiLewat && (!$application->bpn_rapat_dt || !$rapatLewat)); @endphp"
    )
    content = content.replace(
        "@php $isStep4Active = ($application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document); @endphp",
        "@php $isStep4Active = (Auth::user()->isBpn() && $application->bpn_rapat_dt && $rapatLewat && !$application->bpn_pertek_document); @endphp"
    )
    
    # 3. Remove the ending </div> @endif
    content = re.sub(r"</div>\s*@endif\s*</div>\s*@endif\s*<div class=\"layout-grid\">", "</div>\n\n            <div class=\"layout-grid\">", content)

    with open(f'resources/views/{module}/show.blade.php', 'w', encoding='utf-8') as f:
        f.write(content)

print("Done tanah-timbul & kebijakan")
