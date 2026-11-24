{{-- Modal pengingat unduh dokumen khusus Pemohon (pelaku_usaha), desain flat solid & key storage terisolasi per user + layanan --}}
@php
    $docPertekUrl = !empty($application->bpn_pertek_document)
        ? route('file.view', ['path' => $application->bpn_pertek_document])
        : '';
    $finalPath = $application->satu_pintu_document ?? $application->approval_document ?? null;
    $docApprovalUrl = !empty($finalPath)
        ? route('file.view', ['path' => $finalPath])
        : '';
    $docSpsUrl = (!empty($application->bpn_sps_document) && ($application->bpn_pembayaran_status ?? '') !== 'sudah_bayar')
        ? route('file.view', ['path' => $application->bpn_sps_document])
        : '';
    $hasReminderDocs = Auth::check() && Auth::user()->isPelakuUsaha() && ($docPertekUrl || $docApprovalUrl || $docSpsUrl);
@endphp

@if($hasReminderDocs)
    <div id="docReminderModal" class="doc-reminder-backdrop" style="display: none;">
        <div class="doc-reminder-dialog" role="dialog" aria-modal="true" aria-labelledby="reminderModalTitle">
            <div class="doc-reminder-head">
                <button type="button" onclick="closeDocReminderModal()" class="doc-reminder-close" aria-label="Tutup">&times;</button>
                <div class="doc-reminder-icon">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 id="reminderModalTitle" class="doc-reminder-title">Dokumen Telah Terbit</h3>
                <div class="doc-reminder-sub">No. Permohonan: <strong>{{ $application->application_number }}</strong></div>
            </div>

            <div class="doc-reminder-body">
                <p id="reminderModalDesc" class="doc-reminder-desc">
                    Dokumen resmi Anda telah diterbitkan. Silakan unduh dan simpan berkas Anda.
                </p>

                <div class="doc-reminder-note">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#B45309" stroke-width="2" style="flex-shrink:0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                    <span>Anda belum mengunduh berkas ini di perangkat ini. Segera unduh &amp; simpan sebagai arsip.</span>
                </div>

                <div class="doc-reminder-actions">
                    <a id="reminderModalBtn" href="#" target="_blank" class="doc-reminder-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span>Unduh Dokumen Sekarang</span>
                    </a>
                    <button type="button" onclick="closeDocReminderModal()" class="doc-reminder-btn-muted">
                        Nanti Saja
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .doc-reminder-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            z-index: 99999;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }
        .doc-reminder-dialog {
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 4px;
            width: 100%;
            max-width: 430px;
            overflow: hidden;
            animation: appDetailFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .doc-reminder-head {
            background: #003B64;
            padding: 20px 20px 16px;
            color: #FFFFFF;
            position: relative;
            text-align: center;
        }
        .doc-reminder-close {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 28px;
            height: 28px;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.28);
            background: rgba(255, 255, 255, 0.12);
            color: #FFFFFF;
            font-size: 16px;
            line-height: 1;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .doc-reminder-close:hover { background: rgba(255, 255, 255, 0.22); }
        .doc-reminder-icon {
            width: 42px;
            height: 42px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.24);
            color: #FFFFFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        .doc-reminder-title {
            font-size: 16px;
            font-weight: 800;
            color: #FFFFFF;
            margin: 0 0 4px;
        }
        .doc-reminder-sub {
            font-size: 12px;
            color: #CFE4F5;
        }
        .doc-reminder-body {
            padding: 18px 20px 20px;
        }
        .doc-reminder-desc {
            font-size: 13px;
            color: #334155;
            line-height: 1.5;
            margin: 0 0 14px;
            text-align: center;
        }
        .doc-reminder-note {
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 4px;
            padding: 10px 12px;
            font-size: 12px;
            color: #92400E;
            margin-bottom: 16px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.45;
        }
        .doc-reminder-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .doc-reminder-btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #16A34A;
            color: #FFFFFF;
            padding: 10px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: background .15s ease;
        }
        .doc-reminder-btn-primary:hover { background: #15803D; color: #FFFFFF; }
        .doc-reminder-btn-muted {
            background: transparent;
            border: none;
            color: #64748B;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            padding: 6px;
        }
        .doc-reminder-btn-muted:hover { color: #0F172A; }
    </style>

    <script>
        function closeDocReminderModal() {
            const modal = document.getElementById('docReminderModal');
            if (modal) modal.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const appId = '{{ $application->id }}';
            const userId = '{{ Auth::id() }}';
            const modSlug = '{{ $moduleSlug ?? "layanan" }}';
            const serviceLabel = @json($serviceLabel ?? 'Layanan Pertanahan');
            const lsPrefix = 'downloaded_doc_' + modSlug + '_u' + userId + '_';

            const pertekUrl = '{{ $docPertekUrl }}';
            const approvalUrl = '{{ $docApprovalUrl }}';
            const spsUrl = '{{ $docSpsUrl }}';

            let activeDocKey = '';
            let activeUrl = '';
            let activeTitle = '';
            let activeDesc = '';

            if (approvalUrl && !localStorage.getItem(lsPrefix + 'approval_' + appId)) {
                activeDocKey = 'approval_' + appId;
                activeUrl = approvalUrl;
                activeTitle = 'Dokumen ' + serviceLabel + ' Telah Terbit!';
                activeDesc = 'Dokumen resmi ' + serviceLabel + ' milik Anda telah diterbitkan secara lengkap.';
            } else if (pertekUrl && !localStorage.getItem(lsPrefix + 'pertek_' + appId)) {
                activeDocKey = 'pertek_' + appId;
                activeUrl = pertekUrl;
                activeTitle = 'Dokumen Pertek Pertanahan Telah Terbit!';
                activeDesc = 'Dokumen resmi Pertimbangan Teknis Pertanahan (' + serviceLabel + ') sudah selesai diterbitkan.';
            } else if (spsUrl && !localStorage.getItem(lsPrefix + 'sps_' + appId)) {
                activeDocKey = 'sps_' + appId;
                activeUrl = spsUrl;
                activeTitle = 'Dokumen Tagihan SPS (PNBP) Siap Diunduh';
                activeDesc = 'Silakan unduh Surat Perintah Setor (SPS) untuk melakukan pembayaran tagihan PNBP.';
            }

            if (activeUrl) {
                const modalTitle = document.getElementById('reminderModalTitle');
                const modalDesc = document.getElementById('reminderModalDesc');
                const modalBtn = document.getElementById('reminderModalBtn');

                if (modalTitle) modalTitle.innerText = activeTitle;
                if (modalDesc) modalDesc.innerText = activeDesc;
                if (modalBtn) {
                    modalBtn.href = activeUrl;
                    modalBtn.onclick = function() {
                        localStorage.setItem(lsPrefix + activeDocKey, 'true');
                        closeDocReminderModal();
                    };
                }

                setTimeout(function() {
                    const modal = document.getElementById('docReminderModal');
                    if (modal) modal.style.display = 'flex';
                }, 400);
            }

            if (approvalUrl) {
                document.querySelectorAll('a[href*="' + approvalUrl + '"]').forEach(function(l) {
                    l.addEventListener('click', function() { localStorage.setItem(lsPrefix + 'approval_' + appId, 'true'); });
                });
            }
            if (pertekUrl) {
                document.querySelectorAll('a[href*="' + pertekUrl + '"]').forEach(function(l) {
                    l.addEventListener('click', function() { localStorage.setItem(lsPrefix + 'pertek_' + appId, 'true'); });
                });
            }
            if (spsUrl) {
                document.querySelectorAll('a[href*="' + spsUrl + '"]').forEach(function(l) {
                    l.addEventListener('click', function() { localStorage.setItem(lsPrefix + 'sps_' + appId, 'true'); });
                });
            }
        });
    </script>
@endif
