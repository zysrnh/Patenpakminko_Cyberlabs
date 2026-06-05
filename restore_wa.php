<?php
$f='d:/Gawe/Patenpakminko_Cyberlabs/Patenpakminko/resources/views/dpn/whatsapp.blade.php';
$c=file_get_contents($f);
$old = '<div class="form-group" style="margin-bottom: 16px;">
                                <label for="cp_admin" class="form-label">Contact Person Admin (Nomor WA)</label>
                                <input type="text" id="cp_admin" name="cp_admin" class="form-control" placeholder="cth: 08123456789 (Kosongkan jika tidak ingin disisipkan)" value="{{ $settings[\'cp_admin\'] ?? \'\' }}">
                                <span style="font-size: 11px; color: var(--clr-muted); display: block; margin-top: 4px;">Nomor ini akan otomatis ditambahkan pada akhir setiap pesan WA pemohon.</span>
                            </div>

                            <div class="form-group">
                                <label for="template" class="form-label">Format Isi Pesan Notifikasi</label>';
$new = '<div class="form-group">
                                <label for="template" class="form-label">Format Isi Pesan Notifikasi</label>';
$c = str_replace($old, $new, $c);
file_put_contents($f, $c);
echo "Berhasil restore whatsapp.blade.php!";
