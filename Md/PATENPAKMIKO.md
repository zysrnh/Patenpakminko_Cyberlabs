# Spesifikasi Alur Sistem (Workflow Specification) - Project PATENPAKMIKO
*(Status: FINAL & APPROVED)*

Dokumen ini memuat urutan logis alur kerja (flowchart) sistem **PATENPAKMIKO** yang telah divalidasi sepenuhnya. Alur ini dirancang khusus untuk memandu tim pengembang (termasuk AI Developer seperti Antigravity) dalam membangun logika *backend*, *controller*, dan arsitektur aplikasi yang tepat.

---

## 1. Arsitektur Umum & Menu Utama
Sistem ini menggunakan satu titik masuk utama yang mengarah ke 5 pilihan layanan:
- **Titik Awal:** `Mulai` -> `Akses Landing Page` -> `Memilih menu`.
- **5 Pilihan Menu Utama:** 1. LAPOR-PA
  2. PPKPR Non Berusaha
  3. PPKPR Berusaha
  4. Kebijakan
  5. INFORMAL

---

## 2. Detail Urutan Langkah Per Modul

### ALUR 1: LAPOR-PA
Jalur untuk pelaporan atau penjadwalan langsung.
1. Pilih menu **LAPOR-PA**.
2. Input Nomor WhatsApp & Pilih Jadwal.
3. Klik tombol **"Kirim Jadwal"**.
4. Sistem menampilkan panduan kepada pemohon.
5. Sistem menampilkan notif pada dashboard DPN / WhatsApp Blast.
6. **Selesai**.

---

### ALUR 2: PPKPR Non Berusaha
Jalur tanpa proses bisnis lanjutan (Bypass Gistaru & Pembayaran).
1. Pilih menu **PPKPR Non Berusaha**.
2. **Register** -> **Login**.
3. **Unduh Formulir Permohonan** -> **Unduh contoh persyaratan (11 PDF)**.
4. **Submit Persyaratan**.
5. **Kondisi Validasi 1:** Cek Persyaratan Valid?
   - *Tidak Sesuai* -> Sistem menampilkan pesan "Persyaratan tidak sesuai" -> Kembali ke langkah **Submit Persyaratan**.
   - *Sesuai* -> Sistem mengirim **Notif WhatsApp blast ke Pelaku Usaha Untuk Mendaftarkan Berkas ke loket BPN**.
6. Pihak **BPN menentukan dan input jadwal cek lokasi**.
7. BPN menekan button **"kirimkan jadwal cek lokasi"**.
   - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal cek lokasi**.
   - *Berhasil* -> Sistem mengirim **Notif WhatsApp blast ke Pelaku Usaha berupa jadwal dan CP admin**.
8. Tim melakukan **Peninjauan lokasi Offline**.
9. Pihak **BPN menentukan dan input jadwal rapat**.
10. BPN menekan button **"kirimkan jadwal rapat"**.
    - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal rapat**.
    - *Berhasil* -> Para pihak **Melakukan Rapat**.
11. Sistem memproses hingga **Terbit Pertek Pertanahan**.
12. **Selesai**.

---

### ALUR 3: PPKPR Berusaha (Jalur Tengah)
Jalur utama yang paling kompleks, melibatkan peninjauan tata ruang dinas PU.
1. Pilih menu **PPKPR Berusaha**.
2. **Register** -> **Login**.
3. **Unduh Formulir Permohonan** -> **Unduh contoh persyaratan (11 PDF)**.
4. **Submit Persyaratan**.
5. **Kondisi Validasi 1:** Cek Persyaratan Valid?
   - *Tidak Sesuai* -> Sistem menampilkan pesan "Persyaratan tidak sesuai" -> Kembali ke langkah **Submit Persyaratan**.
   - *Sesuai* -> Sistem mengirim **Notif WhatsApp blast ke PU**.
6. PU menekan button **"kirim notifikasi"**.
   - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **Notif WhatsApp blast ke PU**.
   - *Berhasil* -> Sistem mengirim **Notif WhatsApp blast ke Pelaku Usaha dan BPN**.
7. Pihak **BPN cek PKKPR Gistaru**.
8. **Kondisi Validasi 2:** BPN melakukan Validasi terhadap pembayaran.
   - *Belum Bayar* -> BPN mengirimkan notifikasi untuk segera membayar -> Kembali ke langkah **Validasi terhadap pembayaran**.
   - *Sudah Bayar* -> Lanjut ke langkah penentuan jadwal.
9. Pihak **BPN menentukan dan input jadwal cek lokasi**.
10. BPN menekan button **"kirimkan jadwal cek lokasi"**.
    - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal cek lokasi**.
    - *Berhasil* -> Sistem mengirim **Notif WhatsApp blast ke Pelaku Usaha berupa jadwal dan CP admin**.
11. Tim melakukan **Peninjauan lokasi Offline**.
12. Pihak **BPN menentukan dan input jadwal rapat**.
13. BPN menekan button **"kirimkan jadwal rapat"**.
    - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal rapat**.
    - *Berhasil* -> Para pihak **Melakukan Rapat**.
14. Sistem memproses **Terbit Pertek Pertanahan**.
15. Sistem mengirim **Notif ke Pelaku Usaha dan PU Pertek Selesai**.
16. Pihak **PU melakukan penilaian**.
17. **Kondisi Validasi 3:** PU approve berdasarkan penilaian?
    - *Belum Sesuai* -> Sistem mengubah status menjadi "belum sesuai" -> Kembali ke langkah **PU melakukan penilaian**.
    - *Sesuai* -> Sistem mengirim **Notif WhatsApp blast ke 1 pintu**.
18. Petugas **1 pintu melakukan input aksi, nomor PKKPR, tanggal terbit, upload PDF produk akhir**.
19. 1 pintu klik button **"kirim"**.
    - *Gagal* -> Menampilkan pesan kesalahan -> Kembali ke langkah **input 1 pintu**.
    - *Berhasil* -> Sistem mengirim **Notif masuk ke BPN, Pelaku Usaha, dan PU**.
20. **Selesai**.

---

### ALUR 4: Kebijakan
Jalur khusus yang struktur alurnya ekuivalen dengan modul Non Berusaha.
1. Pilih menu **Kebijakan**.
2. **Register** -> **Login** -> **Unduh Formulir Permohonan** -> **Unduh contoh persyaratan (11 PDF)** -> **Submit Persyaratan**.
3. **Kondisi Validasi 1:** Cek Persyaratan Valid?
   - *Tidak Sesuai* -> Tampil pesan tidak sesuai -> Kembali ke langkah **Submit Persyaratan**.
   - *Sesuai* -> Sistem mengirim **Notif WhatsApp blast ke Pelaku Usaha Untuk Mendaftarkan Berkas ke loket BPN**.
4. Pihak **BPN menentukan dan input jadwal cek lokasi**. *(Melewati proses Gistaru & Pembayaran)*
5. BPN menekan button **"kirimkan jadwal cek lokasi"**.
   - *Gagal* -> Tampil pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal cek lokasi**.
   - *Berhasil* -> Sistem mengirim **Notif WhatsApp blast ke Pelaku Usaha berupa jadwal dan CP admin**.
6. Tim melakukan **Peninjauan lokasi Offline**.
7. Pihak **BPN menentukan dan input jadwal rapat**.
8. BPN menekan button **"kirimkan jadwal rapat"**.
   - *Gagal* -> Tampil pesan kesalahan -> Kembali ke langkah **BPN menentukan dan input jadwal rapat**.
   - *Berhasil* -> Para pihak **Melakukan Rapat**.
9. Sistem memproses hingga **Terbit Pertek Pertanahan**.
10. **Selesai**.

---

### ALUR 5: INFORMAL
Jalur cepat tanpa autentikasi untuk pengecekan data spasial.
1. Pilih menu **INFORMAL**.
2. Pengguna **Geser penanda lokasi ke koordinat yang ingin diperiksa**.
3. Klik Button **"Cek Wilayah"**.
4. Sistem **menampilkan detail wilayah**.
5. **Selesai**.
