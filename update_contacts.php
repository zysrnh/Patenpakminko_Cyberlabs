<?php
$f='d:/Gawe/Patenpakminko_Cyberlabs/Patenpakminko/resources/views/dpn/contacts.blade.php';
$c=file_get_contents($f);
$old = '</div>

            <div class="form-actions">';
$new = '<!-- CP Admin (Pemohon) -->
                <div class="contact-item">
                    <div class="contact-badge" style="background: var(--clr-ink); color: white;">CP</div>
                    <div class="contact-info">
                        <div class="contact-label">Contact Person Admin (WA Blast Pemohon)</div>
                        <div class="contact-desc">Nomor ini akan di-blast dan otomatis disisipkan di setiap akhir pesan WhatsApp yang terkirim ke pemohon (Sebagai kontak bantuan).</div>
                        <input type="text" name="cp_admin" class="contact-input" id="cp_admin"
                               placeholder="cth: 081234567890"
                               value="{{ old(\'cp_admin\', $settings[\'cp_admin\'] ?? \'\') }}"
                               inputmode="numeric">
                        @if(!empty($settings[\'cp_admin\']))
                            <div class="contact-current">Tersimpan: <strong>{{ $settings[\'cp_admin\'] }}</strong></div>
                        @else
                            <div class="contact-current" style="color: #E53E3E;">Belum diisi - Info CP Admin tidak akan disisipkan di pesan pemohon.</div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="form-actions">';
$c = str_replace($old, $new, $c);
file_put_contents($f, $c);
echo "Berhasil update contacts.blade.php!";
