# PATENPAKMIKO 🏛️🌱
> **Sistem Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang (PKKPR) & Pelayanan Terpadu Terintegrasi**

Sistem **PATENPAKMIKO** adalah aplikasi berbasis web modern yang dirancang untuk mendigitalisasi, mengotomatisasi, dan menyelaraskan alur pengajuan tata ruang serta perizinan pertanahan secara komprehensif. Aplikasi ini mengintegrasikan berbagai aktor instansi (BPN, Dinas Pekerjaan Umum/Tata Ruang, Dinas 1 Pintu/PTSP) dengan Pelaku Usaha dan Masyarakat Umum dalam satu ekosistem digital yang efisien, transparan, dan aman.

---

## 🎨 Visual Identity & Aesthetics
Aplikasi dibangun dengan standar estetika premium:
* **Brand Color Utama:** **Emerald Green (`#006644`)** — Merepresentasikan profesionalisme, keberlanjutan, dan instansi pertanahan yang berwibawa.
* **UI Style:** Modern *Glassmorphism* dengan shadow halus, kelengkungan sudut (`rounded-2xl`), dipadukan dengan tipografi modern (**Outfit / Inter**) serta transisi antarmuka yang sangat halus.

---

## 🚀 5 Alur Kerja Utama (Core Workflows)

Sistem melayani 5 alur kebutuhan yang dapat diakses dari halaman utama:

### 1. ALUR 1: LAPOR-PA (Pelaporan & Penjadwalan Aduan)
Alur pengaduan langsung bagi masyarakat:
* Input Nomor WhatsApp & Pilih Jadwal rencana audiensi.
* Tombol "Kirim Jadwal" memicu notifikasi ke panel **Super Admin (DPN)** dan log WhatsApp blast.
* Sistem menampilkan panduan lengkap tindak lanjut langsung di layar pemohon.

### 2. ALUR 2: PPKPR Non Berusaha (Bypass Gistaru & Pembayaran)
Alur cepat khusus non-bisnis yang memotong jalur spasial Gistaru & Pembayaran PNBP:
* Register & Login $\rightarrow$ Unduh Formulir & 11 PDF syarat $\rightarrow$ Submit berkas digital.
* Validasi Berkas oleh BPN (Jika sesuai $\rightarrow$ WA blast ke PU untuk mendaftarkan berkas fisik ke loket BPN).
* BPN input jadwal cek lokasi $\rightarrow$ Peninjauan Lapangan Offline.
* BPN input jadwal rapat $\rightarrow$ Rapat pleno koordinasi.
* Penerbitan **Pertimbangan Teknis (Pertek) Pertanahan**.

### 3. ALUR 3: PPKPR Berusaha (Jalur Tengah - Kompleks)
Alur perizinan tata ruang terpadu berskala bisnis besar:
* Register & Login $\rightarrow$ Unduh Formulir & 11 PDF syarat $\rightarrow$ Submit berkas digital.
* Validasi Berkas BPN $\rightarrow$ PU kirim notifikasi $\rightarrow$ WA blast ke PU & BPN.
* BPN cek PKKPR Gistaru $\rightarrow$ Verifikasi Pembayaran PNBP (tagihan/lunas).
* BPN input jadwal cek lokasi $\rightarrow$ Cek lapangan offline $\rightarrow$ Rapat pleno koordinasi.
* Penerbitan Pertek Pertanahan oleh BPN.
* **Penilaian Teknis Dinas PU:** Dinas PU (Tata Ruang) menguji berkas (Sesuai $\rightarrow$ WA blast ke 1 Pintu).
* **Finalisasi 1 Pintu (PTSP):** Input Nomor PKKPR, Tanggal Terbit, dan Unggah PDF produk akhir $\rightarrow$ Notifikasi rilis final dikirim ke BPN, PU, dan Pelaku Usaha.

### 4. ALUR 4: Kebijakan (Bypass Gistaru & Pembayaran)
Alur permohonan berbasis kebijakan (strukturnya ekuivalen penuh dengan *Non Berusaha*):
* Register/Login $\rightarrow$ Submit berkas digital.
* Validasi Berkas BPN $\rightarrow$ WhatsApp loket fisik BPN.
* BPN input jadwal cek lokasi lapangan $\rightarrow$ Cek lapangan offline.
* BPN input jadwal rapat pleno $\rightarrow$ Rapat koordinasi.
* Penerbitan Pertek Pertanahan.

### 5. ALUR 5: INFORMAL (Cek Wilayah Mandiri)
Modul peta spasial interaktif publik tanpa autentikasi/login:
* Pengguna menggeser penanda lokasi (marker) ke titik koordinat peta.
* Tombol "Cek Wilayah" memetakan zona koordinat secara *real-time*.
* Sistem menampilkan detail zonasi wilayah (RTRW) serta status izin peruntukan.

---

## 👥 Aktor & Hak Akses (Multi-Role)

| Aktor | Role String | Deskripsi Hak Akses |
| :--- | :--- | :--- |
| **Pelaku Usaha (PU)** | `pelaku_usaha` | Mengajukan permohonan, submit berkas, memantau berkas, download produk akhir, memberikan rating. |
| **BPN** | `bpn` | Melakukan cek berkas awal, cek Gistaru, verifikasi bayar, input jadwal lokasi/rapat, terbitkan Pertek. |
| **Dinas PU** | `dinas_pu` | Melakukan analisis tata ruang teknis pasca-Pertek, menyetujui/menolak kelayakan spasial. |
| **Dinas 1 Pintu** | `satu_pintu` | Menginput nomor PKKPR resmi, mengunggah PDF produk akhir untuk didistribusikan. |
| **Super Admin (DPN)** | `dpn` | Mengelola data aduan LAPOR-PA, audit log simulator WhatsApp blast, dan konfigurasi global. |

---

## 🛠️ Tech Stack & Dependencies
* **Core Framework:** Laravel 13 (PHP ^8.3)
* **Vite Bundler:** Asset compiler frontend
* **Database Engine:** MySQL / MariaDB
* **Map Engine (Spasial):** Leaflet.js / OpenStreetMap
* **Notification Integrator:** WhatsApp Blast API (Simulator Local Logs)

---

## 💻 Panduan Instalasi Lokal

### 1. Prasyarat
Pastikan komputer Anda sudah terinstal:
* PHP >= 8.3
* Composer
* Node.js & NPM
* MySQL Server (XAMPP / Laragon / Native)

### 2. Kloning & Pengaturan Dependensi
Masuk ke direktori proyek dan jalankan install composer:
```bash
cd Patenpakminko
composer install
npm install
```

### 3. Konfigurasi Environment (`.env`)
Salin file konfigurasi contoh dan buat file `.env` baru:
```bash
cp .env.example .env
```
Sesuaikan konfigurasi database Anda di dalam `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Paten_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Inisialisasi Database & Key
Generate Application Key, buat database `Paten_db` di MySQL Anda, kemudian jalankan migrasi:
```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Menjalankan Server Pengembangan
Jalankan dev-server PHP Artisan dan Vite compiler secara bersamaan:
```bash
npm run dev
```

Aplikasi sekarang dapat diakses secara lokal di [http://localhost:8000](http://localhost:8000)!

---
*© 2026 PATENPAKMIKO - Project developed by Cyberlabs Team*
