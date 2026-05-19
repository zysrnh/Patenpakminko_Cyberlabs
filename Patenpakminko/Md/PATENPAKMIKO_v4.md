# Spesifikasi Alur Sistem (Workflow Specification) - Project PATENPAKMIKO
*(Status: FINAL & STRICT)*

Dokumen ini memuat urutan logis alur kerja (flowchart) sistem **PATENPAKMIKO** yang bersih dan ketat, hanya memuat langkah-langkah aktif tanpa catatan penjelasan transisi atau bypass, agar dapat diproses secara akurat oleh AI Developer / Code Generator.

---

## 1. Arsitektur Umum & Menu Utama
Sistem dimulai dari satu pintu masuk utama yang bercabang menjadi 5 modul layanan:
- **Titik Awal:** `Mulai` -> `Akses Landing Page` -> `Memilih menu`.
- **5 Pilihan Menu Utama:** 1. LAPOR-PA
  2. PPKPR Non Berusaha
  3. PPKPR Berusaha
  4. Kebijakan
  5. INFORMAL

---

## 2. Detail Urutan Langkah Per Modul

### ALUR 1: LAPOR-PA
1. Pilih menu **LAPOR-PA**.
2. **Input Nomor WhatsApp & Pilih Jadwal**.
3. Klik tombol **"Kirim Jadwal"**.
4. Sistem **Menampilkan panduan kepada pemohon**.
5. Sistem **Menampilkan notif pada dashboard DPN/WhatsApp Blast**.
6. **Selesai**.

---

### ALUR 2: PPKPR Non Berusaha
1. Pilih menu **PPKPR Non Berusaha**.
2. **Register** -> **Login**.
3. **Unduh Formulir Permohonan** -> **Unduh contoh persyaratan (11 PDF)**.
4. **Submit Persyaratan**.
5. **Kondisi Validasi 1:** Cek Persyaratan Valid?
   - *Tidak Sesuai* -> Menampilkan pesan "Persyaratan tidak sesuai" -> Kembali ke langkah **Submit Persyaratan**.
   - *Sesuai* -> **Notif WhatsApp blast ke Pelaku Usaha Untuk Mendaftarkan Berkas ke loket BPN**.
6. **BPN menentukan dan input jadwal cek lokasi**.
7. BPN menekan button **"kirimkan jadwal cek lokasi"**.
   - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal cek lokasi**.
   - *Berhasil* -> **Notif WhatsApp blast ke Pelaku Usaha berupa jadwal dan CP admin**.
8. **Peninjauan lokasi Offline**.
9. **BPN menentukan dan input jadwal rapat**.
10. BPN menekan button **"kirimkan jadwal rapat"**.
    - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal rapat**.
    - *Berhasil* -> **Melakukan Rapat**.
11. **Terbit Pertek Pertanahan**.
12. **Selesai**.

---

### ALUR 3: PPKPR Berusaha (Jalur Tengah)
1. Pilih menu **PPKPR Berusaha**.
2. **Register** -> **Login**.
3. **Unduh Formulir Permohonan** -> **Unduh contoh persyaratan (11 PDF)**.
4. **Submit Persyaratan**.
5. **Kondisi Validasi 1:** Cek Persyaratan Valid?
   - *Tidak Sesuai* -> Menampilkan pesan "Persyaratan tidak sesuai" -> Kembali ke langkah **Submit Persyaratan**.
   - *Sesuai* -> **Notif WhatsApp blast ke PU**.
6. PU menekan button **"kirim notifikasi"**.
   - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **Notif WhatsApp blast ke PU**.
   - *Berhasil* -> **Notif WhatsApp blast ke Pelaku Usaha dan BPN**.
7. **BPN cek PKKPR Gistaru**.
8. **Kondisi Validasi 2:** BPN melakukan Validasi terhadap pembayaran.
   - *Belum Bayar* -> BPN Mengirimkan notifikasi untuk segera membayar -> Kembali ke langkah **BPN melakukan Validasi terhadap pembayaran**.
   - *Sudah Bayar* -> **BPN menentukan dan input jadwal cek lokasi**.
9. BPN menekan button **"kirimkan jadwal cek lokasi"**.
    - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal cek lokasi**.
    - *Berhasil* -> **Notif WhatsApp blast ke Pelaku Usaha berupa jadwal dan CP admin**.
10. **Peninjauan lokasi Offline**.
11. **BPN menentukan dan input jadwal rapat**.
12. BPN menekan button **"kirimkan jadwal rapat"**.
    - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal rapat**.
    - *Berhasil* -> **Melakukan Rapat**.
13. **Terbit Pertek Pertanahan**.
14. **Notif ke Pelaku Usaha dan PU Pertek Selesai**.
15. **PU melakukan penilaian**.
16. **Kondisi Validasi 3:** PU approve berdasarkan penilaian?
    - *Belum Sesuai* -> Mengubah status "belum sesuai" -> Kembali ke langkah **PU melakukan penilaian**.
    - *Sesuai* -> **Notif WhatsApp blast ke 1 pintu**.
17. **1 pintu input aksi, nomor PKKPR, tanggal terbit, upload pdf produk akhir**.
18. 1 pintu klik button **"kirim"**.
    - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **1 pintu input aksi, nomor PKKPR, tanggal terbit, upload pdf produk akhir**.
    - *Berhasil* -> **Notif masuk ke BPN, Pelaku Usaha, dan PU**.
19. **Selesai**.

---

### ALUR 4: Kebijakan
1. Pilih menu **Kebijakan**.
2. **Register** -> **Login**.
3. **Unduh Formulir Permohonan** -> **Unduh contoh persyaratan (11 PDF)**.
4. **Submit Persyaratan**.
5. **Kondisi Validasi 1:** Cek Persyaratan Valid?
   - *Tidak Sesuai* -> Menampilkan pesan "Persyaratan tidak sesuai" -> Kembali ke langkah **Submit Persyaratan**.
   - *Sesuai* -> **Notif WhatsApp blast ke Pelaku Usaha Untuk Mendaftarkan Berkas ke loket BPN**.
6. **BPN menentukan dan input jadwal cek lokasi**.
7. BPN menekan button **"kirimkan jadwal cek lokasi"**.
   - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal cek lokasi**.
   - *Berhasil* -> **Notif WhatsApp blast ke Pelaku Usaha berupa jadwal dan CP admin**.
8. **Peninjauan lokasi Offline**.
9. **BPN menentukan dan input jadwal rapat**.
10. BPN menekan button **"kirimkan jadwal rapat"**.
   - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal rapat**.
   - *Berhasil* -> **Melakukan Rapat**.
11. **Terbit Pertek Pertanahan**.
12. **Selesai**.

---

### ALUR 5: INFORMAL
1. Pilih menu **INFORMAL**.
2. **Geser penanda lokasi ke koordinat yang ingin diperiksa**.
3. Klik Button **"Cek Wilayah"**.
4. Sistem **menampilkan detail wilayah**.
5. **Selesai**.
