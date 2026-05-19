# Spesifikasi Alur Sistem (Workflow Specification) - Project PATENPAKMIKO

Dokumen ini memuat seluruh rangkaian urutan logis berdasarkan *flowchart* sistem **PATENPAKMIKO**. Dokumentasi ini disusun secara terstruktur dengan penamaan aktor, validasi kondisi (percabangan), dan urutan langkah yang jelas agar mudah dipahami oleh AI Developer / Code Generator (seperti Antigravity).

---

## 1. Arsitektur Umum & Menu Utama
Sistem dimulai dari satu titik masuk (*entry point*) dan terbagi menjadi **5 modul/cabang utama** berdasarkan menu yang dipilih oleh pengguna pada *Landing Page*.

- **Titik Awal:** `Mulai` -> `Akses Landing Page` -> `Memilih menu` (Kondisi Percabangan).
- **5 Pilihan Menu Utama:**
  1. **LAPOR-PA** (Jalur Pengaduan/Pelaporan)
  2. **PPKPR Non Berusaha** (Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang - Non Berusaha)
  3. **PPKPR Berusaha** (Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang - Berusaha)
  4. **Kebijakan** (Jalur Khusus Kebijakan)
  5. **INFORMAL** (Fitur Cek Wilayah Mandiri)

---

## 2. Detail Urutan Langkah Per Modul

### MODUL 1: LAPOR-PA
Jalur ini digunakan untuk pelaporan atau penjadwalan langsung oleh pemohon.
1. Pemohon memilih menu **LAPOR-PA**.
2. Pemohon melakukan **Input Nomor WhatsApp & Pilih Jadwal**.
3. Pemohon mengklik tombol **"Kirim Jadwal"**.
4. Sistem **Menampilkan panduan kepada pemohon**.
5. Sistem otomatis **Menampilkan notifikasi pada dashboard DPN / WhatsApp Client**.
6. Alur selesai -> Menuju **Selesai**.

---

### MODUL 2: PPKPR Non Berusaha
Jalur ini melibatkan proses registrasi, submit berkas, validasi oleh BPN, peninjauan lokasi, hingga penerbitan Pertek.
1. Pemohon memilih menu **PPKPR Non Berusaha**.
2. Pemohon melakukan **Register** akun (jika belum punya).
3. Pemohon melakukan **Login** ke sistem.
4. Pemohon melakukan **Unduh Formulir Permohonan**.
5. Pemohon melakukan **Unduh contoh persyaratan (11 PDF)** sebagai panduan berkas.
6. Pemohon melakukan **Submit Persyaratan** (mengunggah dokumen yang diminta).
7. **Kondisi Validasi 1 (Sistem/BPN):** Apakah `Persyaratan Valid?`
   - **Jika Tidak Sesuai:** Sistem akan *Menampilkan pesan Persyaratan tidak sesuai* dan kembali ke proses *Submit Persyaratan*.
   - **Jika Sesuai:** Lanjut ke langkah berikutnya.
8. Sistem mengirimkan **Notif WhatsApp blast ke PU** (Pelaku Usaha/Pemohon).
9. **Kondisi Aksi 2 (Pemohon):** `PU menekan button "kirim notifikasi"`
   - **Jika Gagal:** Sistem *Menampilkan pesan kesalahan*.
   - **Jika Berhasil:** Lanjut.
10. Sistem mengirimkan **Notif WhatsApp blast ke Pelaku Usaha dan BPN**.
11. Pihak **BPN melakukan cek PKKPR Gistaru**.
12. **Kondisi Validasi 3 (BPN):** `BPN melakukan Validasi terhadap pembayaran`
    - **Jika Belum Bayar:** BPN akan *Mengirimkan notifikasi untuk segera membayar*.
    - **Jika Sudah Bayar:** Lanjut ke langkah berikutnya.
13. Pihak **BPN menentukan dan input jadwal cek lokasi**.
14. **Kondisi Aksi 4 (BPN):** `BPN menekan button "kirimkan jadwal cek lokasi"`
    - **Jika Gagal:** Sistem *Menampilkan pesan kesalahan*.
    - **Jika Berhasil:** Lanjut.
15. Sistem mengirimkan **Notif WhatsApp blast ke Pelaku Usaha berupa jadwal dan CP admin**.
16. Tim melakukan **Peninjauan lokasi Offline** di lapangan.
17. Pihak **BPN menentukan dan input jadwal rapat**.
18. **Kondisi Aksi 5 (BPN):** `BPN menekan button "kirimkan jadwal rapat"`
    - **Jika Gagal:** Sistem *Menampilkan pesan kesalahan*.
    - **Jika Berhasil:** Lanjut.
19. Para pihak Terkait bersama BPN **Melakukan Rapat**.
20. Sistem memproses hingga **Terbit Pertek Pertanahan**.
21. Alur selesai -> Menuju **Selesai**.

---

### MODUL 3: PPKPR Berusaha (Jalur Tengah)
Jalur ini adalah yang paling kompleks karena melibatkan instansi PU (Pekerjaan Umum/Penataan Ruang) untuk penilaian teknis ruang dan sistem Terintegrasi Satu Pintu (1 Pintu).
1. Pemohon memilih menu **PPKPR Berusaha**.
2. Pemohon melakukan **Register** akun.
3. Pemohon melakukan **Login** ke dalam sistem.
4. Pemohon melakukan **Unduh Formulir Permohonan**.
5. Pemohon melakukan **Unduh contoh persyaratan (11 PDF)**.
6. Pemohon melakukan **Submit Persyaratan**.
7. **Kondisi Validasi 1:** Apakah `Persyaratan Valid?`
   - **Jika Tidak Sesuai:** Sistem *Menampilkan pesan Persyaratan tidak sesuai* -> Kembali ke *Submit Persyaratan*.
   - **Jika Sesuai:** Lanjut.
8. Sistem mengirimkan **Notif WhatsApp blast ke PU** (Pemohon).
9. **Kondisi Aksi 2:** `PU menekan button "kirim notifikasi"`
   - **Jika Gagal:** Sistem *Menampilkan pesan kesalahan*.
   - **Jika Berhasil:** Lanjut.
10. Sistem mengirimkan **Notif WhatsApp blast ke Pelaku Usaha dan BPN**.
11. Pihak **BPN melakukan cek PKKPR Gistaru**.
12. **Kondisi Validasi 3:** `BPN melakukan Validasi terhadap pembayaran`
    - **Jika Belum Bayar:** BPN *Mengirimkan notifikasi untuk segera membayar*.
    - **Jika Sudah Bayar:** Lanjut.
13. Pihak **BPN menentukan dan input jadwal cek lokasi**.
14. **Kondisi Aksi 4:** `BPN menekan button "kirimkan jadwal cek lokasi"`
    - **Jika Gagal:** Sistem *Menampilkan pesan kesalahan*.
    - **Jika Berhasil:** Lanjut.
15. Sistem mengirimkan **Notif WhatsApp blast ke Pelaku Usaha berupa jadwal dan CP admin**.
16. Tim melakukan **Peninjauan lokasi Offline**.
17. Pihak **BPN menentukan dan input jadwal rapat**.
18. **Kondisi Aksi 5:** `BPN menekan button "kirimkan jadwal rapat"`
    - **Jika Gagal:** Sistem *Menampilkan pesan kesalahan*.
    - **Jika Berhasil:** Lanjut.
19. Sistem mengirimkan **Notif WhatsApp blast ke Pelaku Usaha dan PU** (Dinas Pekerjaan Umum/Penataan Ruang).
20. Pihak **PU melakukan penilaian** teknis terhadap tata ruang.
21. **Kondisi Validasi 6 (PU):** `PU approve berdasarkan penilaian`
    - **Jika Belum Sesuai:** Sistem *Mengubah status menjadi "belum sesuai"*.
    - **Jika Sesuai:** Lanjut.
22. Sistem mengirimkan **Notif WhatsApp blast ke 1 pintu** (Sistem Pelayanan Terpadu Satu Pintu).
23. Petugas **1 pintu melakukan input aksi, nomor PKKPR, tanggal terbit, dan upload pdf produk akhir**.
24. **Kondisi Aksi 7 (1 Pintu):** `1 pintu klik button "kirim"`
    - **Jika Gagal:** Sistem *Menampilkan pesan kesalahan*.
    - **Jika Berhasil:** Lanjut.
25. Sistem mengirimkan **Notif masuk ke BPN, Pelaku Usaha, dan PU** secara simultan sebagai tanda proses selesai.
26. Alur selesai -> Menuju **Selesai**.

---

### MODUL 4: Kebijakan
Modul ini memiliki struktur langkah dan integrasi yang sama persis dengan modul *PPKPR Non Berusaha*, namun ditujukan khusus untuk kategori permohonan berbasis Kebijakan tertentu.
1. Pemohon memilih menu **Kebijakan**.
2. Proses **Register** -> **Login** -> **Unduh Formulir Permohonan** -> **Unduh contoh persyaratan (11 PDF)**.
3. Pemohon melakukan **Submit Persyaratan**.
4. **Kondisi Validasi 1:** `Persyaratan Valid?` (Jika tidak sesuai, tampilkan pesan kesalahan & kembali ke submit).
5. Sistem mengirimkan **Notif WhatsApp blast ke PU**.
6. `PU menekan button "kirim notifikasi"` -> Jika sukses, lanjut.
7. Sistem mengirimkan **Notif WhatsApp blast ke Pelaku Usaha dan BPN**.
8. **BPN cek PKKPR Gistaru** -> **BPN melakukan Validasi terhadap pembayaran** (Jika belum bayar, kirimkan notifikasi segera bayar).
9. **BPN menentukan dan input jadwal cek lokasi** -> Klik `"kirimkan jadwal cek lokasi"` -> Sukses.
10. Sistem mengirimkan **Notif WhatsApp blast ke Pelaku Usaha berupa jadwal dan CP admin**.
11. Tim melakukan **Peninjauan lokasi Offline**.
12. **BPN menentukan dan input jadwal rapat** -> Klik `"kirimkan jadwal rapat"` -> Sukses.
13. Para pihak bersama BPN **Melakukan Rapat**.
14. Sistem memproses hingga **Terbit Pertek Pertanahan**.
15. Alur selesai -> Menuju **Selesai**.

---

### MODUL 5: INFORMAL
Jalur mandiri paling cepat dan ringkas yang bisa diakses langsung oleh user tanpa perlu login/proses berbelit untuk memeriksa status wilayah.
1. Pengguna memilih menu **INFORMAL**.
2. Pengguna melakukan aksi **Geser penanda lokasi ke koordinat yang ingin diperiksa** pada peta/interface.
3. Pengguna mengklik tombol/button **"Cek Wilayah"**.
4. **Sistem menampilkan detail wilayah** secara otomatis (misal: zonasi, peruntukan lahan, dll).
5. Alur selesai -> Menuju **Selesai**.

---

## 3. Kamus Istilah / Glosarium Proyek (Untuk Konteks AI)
Untuk memastikan AI seperti Antigravity mengonstruksi database dan logic backend dengan benar, berikut arti singkatan pada flowchart:
- **PU:** Pelaku Usaha (Pemohon) / Pada Modul Berusaha juga merepresentasikan instansi **Pekerjaan Umum / Dinas Penataan Ruang** selaku penilai teknis.
- **BPN:** Badan Pertanahan Nasional (Aktor Validator Utama & Penerbit Pertek).
- **DPN:** Dashboard Penerima Notifikasi / Unit Pengolah Aduan internal.
- **PKKPR:** Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang.
- **Gistaru:** GIS Tata Ruang (Sistem basis data spasial eksternal/internal yang di-cek oleh BPN).
- **Pertek:** Pertimbangan Teknis (Produk hukum akhir keluaran BPN).
- **1 Pintu:** PTSP (Pelayanan Terpadu Satu Pintu) / Gatekeeper unggah dokumen produk akhir.
- **WhatsApp Blast:** Sistem integrasi API WhatsApp untuk notifikasi otomatis (*automated notifications*) pada setiap *checkpoint* keberhasilan aksi.
