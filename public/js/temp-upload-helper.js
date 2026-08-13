/**
 * PATEN PAK MIKO - Automatic Instant Temp Document Upload & Preservation Helper
 * Preserves uploaded documents across form reloads (including manual F5 refresh) and pre-validates forms before submit.
 */

document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]') 
        ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        : (window.csrfToken || '');

    const storageKey = 'paten_temp_files_' + window.location.pathname.replace(/[^a-zA-Z0-9]/g, '_');

    function getStoredTempFiles() {
        try {
            return JSON.parse(localStorage.getItem(storageKey)) || {};
        } catch (e) {
            return {};
        }
    }

    function setStoredTempFile(inputName, tempPath, originalName, fileSize) {
        const data = getStoredTempFiles();
        data[inputName] = {
            temp_path: tempPath,
            original_name: originalName,
            file_size: fileSize,
            timestamp: Date.now()
        };
        try {
            localStorage.setItem(storageKey, JSON.stringify(data));
        } catch (e) {}
    }

    function removeStoredTempFile(inputName) {
        const data = getStoredTempFiles();
        delete data[inputName];
        try {
            localStorage.setItem(storageKey, JSON.stringify(data));
        } catch (e) {}
    }

    function clearStoredTempFiles() {
        try {
            localStorage.removeItem(storageKey);
        } catch (e) {}
    }

    // Inject CSS styles for temp badges & upload animations
    const style = document.createElement('style');
    style.innerHTML = `
        .temp-upload-badge {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #F0FDF4;
            border: 1.5px solid #86EFAC;
            border-radius: 6px;
            padding: 8px 12px;
            margin-top: 6px;
            font-size: 12px;
            color: #166534;
            animation: fadeIn 0.3s ease;
        }
        .temp-upload-info {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .temp-upload-icon {
            color: #22C55E;
            font-size: 14px;
            font-weight: 800;
            flex-shrink: 0;
        }
        .temp-upload-filename {
            font-weight: 700;
            color: #15803D;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .temp-upload-status {
            font-size: 10.5px;
            color: #16A34A;
            background: #DCFCE7;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
            flex-shrink: 0;
        }
        .btn-remove-temp {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
            border-radius: 4px;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            margin-left: 8px;
            flex-shrink: 0;
        }
        .btn-remove-temp:hover {
            background: #EF4444;
            color: #FFFFFF;
        }
        .temp-upload-loading {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            color: #2563EB;
            margin-top: 6px;
            font-weight: 600;
        }
        .temp-spinner {
            width: 14px;
            height: 14px;
            border: 2px solid #BFDBFE;
            border-top-color: #2563EB;
            border-radius: 50%;
            animation: tempSpin 0.8s linear infinite;
        }
        @keyframes tempSpin {
            to { transform: rotate(360deg); }
        }
        .form-group.field-missing-error {
            border: 2px solid #EF4444 !important;
            background: #FEF2F2 !important;
            padding: 12px !important;
            border-radius: 8px !important;
            animation: pulseError 0.5s ease;
        }
        @keyframes pulseError {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(style);

    // Target all document file inputs inside form
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const fileInputs = form.querySelectorAll('input[type="file"]');
        if (fileInputs.length === 0) return;

        const storedFiles = getStoredTempFiles();

        fileInputs.forEach(input => {
            const inputName = input.getAttribute('name');
            if (!inputName) return;

            const wrapper = input.closest('.file-input-wrapper') || input.parentNode;
            
            // Check if there is already a preserved temp input in DOM or localStorage
            let tempInput = form.querySelector(`input[name="temp_${inputName}"]`);
            let tempNameInput = form.querySelector(`input[name="temp_name_${inputName}"]`);

            const saved = storedFiles[inputName];

            if ((tempInput && tempInput.value) || saved) {
                const tempPath = (tempInput && tempInput.value) ? tempInput.value : saved.temp_path;
                const preservedName = (tempNameInput && tempNameInput.value) ? tempNameInput.value : (saved ? saved.original_name : 'Dokumen Terunggah');
                const fileSizeText = saved ? saved.file_size : 'Terunggah';

                // Ensure hidden inputs are in DOM
                if (!tempInput) {
                    tempInput = document.createElement('input');
                    tempInput.type = 'hidden';
                    tempInput.name = `temp_${inputName}`;
                    form.appendChild(tempInput);
                }
                tempInput.value = tempPath;

                if (!tempNameInput) {
                    tempNameInput = document.createElement('input');
                    tempNameInput.type = 'hidden';
                    tempNameInput.name = `temp_name_${inputName}`;
                    form.appendChild(tempNameInput);
                }
                tempNameInput.value = preservedName;

                renderTempBadge(wrapper, input, inputName, preservedName, `${fileSizeText} - Terunggah & Tersimpan`);
            }

            // Handle file input change -> Instant visual feedback + background temp upload
            input.addEventListener('change', function () {
                if (!this.files || this.files.length === 0) return;
                const file = this.files[0];

                const initialSizeMB = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                
                // Immediately render custom green card with truncated filename
                renderTempBadge(wrapper, input, inputName, file.name, `${initialSizeMB} - Menyimpan...`);

                const formData = new FormData();
                formData.append('file', file);

                fetch('/api/temp-upload-document', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.temp_path) {
                        let tInput = form.querySelector(`input[name="temp_${inputName}"]`);
                        if (!tInput) {
                            tInput = document.createElement('input');
                            tInput.type = 'hidden';
                            tInput.name = `temp_${inputName}`;
                            form.appendChild(tInput);
                        }
                        tInput.value = data.temp_path;

                        let tNameInput = form.querySelector(`input[name="temp_name_${inputName}"]`);
                        if (!tNameInput) {
                            tNameInput = document.createElement('input');
                            tNameInput.type = 'hidden';
                            tNameInput.name = `temp_name_${inputName}`;
                            form.appendChild(tNameInput);
                        }
                        tNameInput.value = data.original_name;

                        // Save to localStorage for refresh (F5) persistence
                        setStoredTempFile(inputName, data.temp_path, data.original_name, data.file_size);

                        renderTempBadge(wrapper, input, inputName, data.original_name, `${data.file_size} - Terunggah & Tersimpan`);
                    } else {
                        renderTempBadge(wrapper, input, inputName, file.name, `${initialSizeMB} - Terpilih`);
                    }
                })
                .catch(err => {
                    console.error('Error temp upload:', err);
                    renderTempBadge(wrapper, input, inputName, file.name, `${initialSizeMB} - Terpilih`);
                });
            });
        });

        // Form Submit Listener: Client-side validation to prevent page refresh & lost files
        form.addEventListener('submit', function (e) {
            let missingFields = [];
            const allFileInputs = form.querySelectorAll('input[type="file"]');

            allFileInputs.forEach(input => {
                const inputName = input.getAttribute('name');
                if (!inputName) return;

                // Clear previous error styles
                const group = input.closest('.form-group');
                if (group) group.classList.remove('field-missing-error');

                const isRequired = input.hasAttribute('required') || (input.dataset && input.dataset.required === 'true');
                const hasFileSelected = input.files && input.files.length > 0;
                const tempInput = form.querySelector(`input[name="temp_${inputName}"]`);
                const hasTempFile = tempInput && tempInput.value.trim() !== '';

                if (isRequired && !hasFileSelected && !hasTempFile) {
                    if (group && group.style.display !== 'none') { // only if field is visible
                        missingFields.push({
                            input: input,
                            group: group,
                            label: getFieldLabel(group, inputName)
                        });
                    }
                }
            });

            if (missingFields.length > 0) {
                e.preventDefault();

                // Highlight missing fields and scroll to first missing
                missingFields.forEach(item => {
                    if (item.group) item.group.classList.add('field-missing-error');
                });

                const first = missingFields[0];
                if (first.group) {
                    first.group.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }

                // Display top error alert
                let alertBox = document.getElementById('ptpAlertError') || document.querySelector('.ptp-alert-error');
                if (!alertBox) {
                    alertBox = document.createElement('div');
                    alertBox.className = 'ptp-alert ptp-alert-error';
                    alertBox.id = 'ptpAlertError';
                    form.parentNode.insertBefore(alertBox, form);
                }

                const namesList = missingFields.map(f => f.label).join(', ');
                alertBox.innerHTML = `
                    <div class="ptp-alert-content" style="display:flex; gap:12px; align-items:flex-start; background:#FEF2F2; border:1px solid #FCA5A5; padding:14px 18px; border-radius:8px; margin-bottom:20px; color:#991B1B;">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="#EF4444" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <div>
                            <strong style="font-size:14px; display:block; margin-bottom:4px;">Dokumen Belum Lengkap</strong>
                            <span style="font-size:12.5px; line-height:1.5;">Mohon lengkapi berkas persyaratan berikut: <strong>${namesList}</strong>.<br><small style="color:#15803D; font-weight:700;">✓ Catatan: Dokumen yang sudah Anda upload sebelumnya tetap aman tersimpan.</small></span>
                        </div>
                    </div>
                `;
                alertBox.style.display = 'block';
            }
        });

        // Clear all temp storage keys when landing on success page
        if (window.location.pathname.includes('pengajuan/sukses') || window.location.pathname.includes('pengajuan-sukses')) {
            for (let i = localStorage.length - 1; i >= 0; i--) {
                const key = localStorage.key(i);
                if (key && key.startsWith('paten_temp_files_')) {
                    localStorage.removeItem(key);
                }
            }
        }
    });

    function formatTruncatedFilename(name, maxLength = 19) {
        if (!name || name.length <= maxLength) return name;
        const extIndex = name.lastIndexOf('.');
        if (extIndex !== -1 && name.length - extIndex <= 8) {
            const ext = name.substring(extIndex);
            const base = name.substring(0, extIndex);
            const targetLen = maxLength - ext.length - 3;
            if (targetLen > 3) {
                return base.substring(0, targetLen) + '...' + ext;
            }
        }
        return name.substring(0, maxLength - 3) + '...';
    }

    function renderTempBadge(wrapper, input, inputName, filename, statusText) {
        removeTempBadge(wrapper, input);

        input.removeAttribute('required');

        // Hide wrapper completely so dashed border and extra padding don't surround the card
        if (wrapper && wrapper.classList.contains('file-input-wrapper')) {
            wrapper.style.display = 'none';
        } else {
            input.style.display = 'none';
        }

        const parentContainer = wrapper.parentNode;
        
        let badge = parentContainer.querySelector(`#temp-badge-${inputName}`);
        if (badge) badge.remove();

        const displayName = formatTruncatedFilename(filename, 19);

        badge = document.createElement('div');
        badge.className = 'temp-upload-badge';
        badge.id = `temp-badge-${inputName}`;
        badge.style.cssText = 'font-family: "Poppins", -apple-system, BlinkMacSystemFont, sans-serif; background: #F0FDF4; border: 1px solid #86EFAC; border-radius: 6px; padding: 10px 14px; margin-top: 4px; display: flex; align-items: center; justify-content: space-between; gap: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.03); min-height: 48px;';
        
        badge.innerHTML = `
            <div class="btn-trigger-change-file" style="display: flex; align-items: center; gap: 10px; overflow: hidden; flex: 1; cursor: pointer;" title="Klik untuk mengganti file ini">
                <div style="width: 28px; height: 28px; border-radius: 6px; background: #DCFCE7; color: #15803D; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: 700;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div style="display: flex; flex-direction: column; overflow: hidden; max-width: 170px;">
                    <span style="font-family: inherit; font-weight: 600; font-size: 13px; color: #0A1C2C; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${filename}">${displayName}</span>
                    <span style="font-family: inherit; font-size: 11px; color: #16A34A; font-weight: 500;">${statusText}</span>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 6px; flex-shrink: 0;">
                <button type="button" class="btn-replace-temp" style="font-family: inherit; background: #EAF3FA; color: #3291A8; border: 1px solid #BEE3F8; padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: all 0.2s;" title="Ganti file ini">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Ganti
                </button>
                <button type="button" class="btn-remove-temp" style="font-family: inherit; background: #FEF2F2; color: #DC2626; border: 1px solid #FCA5A5; padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: all 0.2s;" title="Hapus file ini">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Hapus
                </button>
            </div>
        `;

        if (wrapper.nextSibling) {
            parentContainer.insertBefore(badge, wrapper.nextSibling);
        } else {
            parentContainer.appendChild(badge);
        }

        const triggerGanti = function() {
            input.click();
        };

        const btnReplace = badge.querySelector('.btn-replace-temp');
        if (btnReplace) btnReplace.addEventListener('click', triggerGanti);

        const infoBlock = badge.querySelector('.btn-trigger-change-file');
        if (infoBlock) infoBlock.addEventListener('click', triggerGanti);

        badge.querySelector('.btn-remove-temp').addEventListener('click', function () {
            removeTempBadge(wrapper, input);
            const form = input.closest('form');
            if (form) {
                const tempInput = form.querySelector(`input[name="temp_${inputName}"]`);
                if (tempInput) tempInput.value = '';
                const tempNameInput = form.querySelector(`input[name="temp_name_${inputName}"]`);
                if (tempNameInput) tempNameInput.value = '';
            }
            removeStoredTempFile(inputName);
            input.value = '';
            input.setAttribute('required', 'required');
        });
    }

    function removeTempBadge(wrapper, input = null) {
        if (!wrapper) return;
        const parentContainer = wrapper.parentNode;
        if (parentContainer) {
            const badges = parentContainer.querySelectorAll('.temp-upload-badge');
            badges.forEach(b => b.remove());
        }

        const loading = wrapper.querySelector('.temp-upload-loading');
        if (loading) loading.remove();

        if (wrapper && wrapper.classList.contains('file-input-wrapper')) {
            wrapper.style.display = 'block';
        }
        if (input) {
            input.style.display = 'block';
        }
        const helpText = wrapper.querySelector('.file-help');
        if (helpText) helpText.style.display = 'block';
    }

    function getFieldLabel(group, fallback) {
        if (!group) return fallback;
        const labelEl = group.querySelector('.label-text') || group.querySelector('label');
        if (labelEl) {
            let text = labelEl.innerText.replace(/\s*\*\s*/g, '').replace(/Lihat Contoh/gi, '').trim();
            return text || fallback;
        }
        return fallback;
    }
});
