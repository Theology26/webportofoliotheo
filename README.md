# Web Portofolio Theo (Cinematic Dynamic CMS & GitHub Tracking)

Selamat datang di repositori web portofolio Theo. Proyek ini dikembangkan dengan arsitektur Laravel 11 dan dirancang sebagai portofolio dinamis yang dilengkapi dengan sistem manajemen konten mandiri (CMS) serta integrasi data GitHub secara otomatis.

---

## 🔗 Link Utama
*   **Linktree:** [https://linktr.ee/TheHighTee](https://linktr.ee/TheHighTee)

---

## ✨ Fitur Terbaru & Keunggulan Visual
Proyek ini telah melalui tahap optimasi estetika tingkat tinggi (Cinematic Overhaul):

### 1. Cinematic Glassmorphism UI
Seluruh antarmuka pada halaman tamu (landing page) maupun Dashboard Admin dipoles menggunakan standar transparansi modern:
- **Unified Canvas**: Seluruh halaman menyatu dengan latar belakang tetap (fixed background).
- **Glassmorphism Revamp**: Panel konten menggunakan efek blur latar belakang tinggi (`backdrop-blur-md`) dengan aksen garis tepi (border) tipis dan shadow premium.
- **Neon Blue Branding**: Logo kustom di navbar dilengkapi dengan frame lingkaran dan efek neon blue glow yang interaktif.

### 2. Efek Visual & Animasi Premium
- **Aurora 3D & Stars**: Background Aurora 3D dan simulasi bintang jatuh murni menggunakan CSS untuk performa maksimal.
- **Reveal on Scroll**: Konten muncul secara halus saat di-scroll menggunakan Intersection Observer API.
- **Interactive Particles**: Background partikel konstelasi yang merespon gerakan kursor.
- **Typography Glow**: Judul section memiliki efek cahaya (glow) sesuai tema warna masing-masing.

### 3. Dynamic CMS & Image Management
- **Dashboard Admin**: Manajemen biodata, pengalaman, projek, dan galeri secara mandiri.
- **Auto-Compress Engine**: Sistem otomatis mengompres foto profil dan logo yang diunggah (hingga 10MB) menjadi format **WebP** yang ringan dan cepat.
- **Favicon Dinamis**: Logo kustom yang diunggah otomatis menjadi icon tab browser.

### 4. Integrasi GitHub & Analytics
- **GitHub API Service**: Fetching repositori publik dan perhitungan Tech Stack secara otomatis.
- **Dashboard Analytics**: Visualisasi data (Chart.js) untuk distribusi bahasa pemrograman dan peringkat repositori.

### 5. Fitur Pendukung Profesional
- **Auto-Generate ATS PDF CV**: Konversi profil menjadi dokumen PDF profesional dalam sekali klik menggunakan DomPDF.
- **Email Project Consultation**: Form kontak yang terintegrasi dengan SMTP (Gmail) untuk pengiriman pesan langsung ke inbox owner.

---

## 🚀 Panduan Menjalankan Sistem Secara Lokal

### Prasyarat:
- PHP versi 8.3 atau lebih baru.
- Composer (Package Manager PHP).
- Node.js dan NPM.
- MySQL/MariaDB aktif (Laragon/XAMPP).

### Tahapan Instalasi:

1. **Clone Repository:**
   ```bash
   git clone https://github.com/Theology26/webportofoliotheo.git
   cd webportofoliotheo
   ```

2. **Konfigurasi Environment:**
   Duplikat file environment:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` dan sesuaikan koneksi database serta SMTP Mail (untuk fitur kontak).

3. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

4. **Generate Key & Link Storage:**
   ```bash
   php artisan key:generate
   php artisan storage:link
   ```

5. **Migrasi & Seeding Data:**
   ```bash
   php artisan migrate --seed
   ```

6. **Build & Serve:**
   ```bash
   npm run build
   php artisan serve
   ```

### 🔐 Kredensial Akses Administrator
Akses login di `/login`:
- **Email**: `admin@admin.com`
- **Password**: `admin123`

---

## 🛠️ Troubleshooting & Tips

### 1. Gambar atau Logo Tidak Muncul?
Pastikan Anda sudah menjalankan perintah `php artisan storage:link`. Jika sudah namun tetap tidak muncul, pastikan nilai `APP_URL` di file `.env` sudah sesuai dengan alamat yang Anda akses di browser (misal: `http://localhost:8000`).

### 2. Perubahan Tidak Terlihat (Cache)?
Jika Anda sudah mengubah data di Admin namun halaman depan tidak berubah, jalankan perintah:
```bash
php artisan optimize:clear
```
Lalu lakukan **Hard Refresh** di browser dengan menekan **Ctrl + F5**.

### 3. Masalah Pengiriman Email?
Pastikan Anda menggunakan **App Password** dari akun Google, bukan password login biasa. Pastikan juga `MAIL_ENCRYPTION` diatur ke `ssl` jika menggunakan port `465`.

### 4. Efek Visual Terhambat?
Pastikan tidak ada elemen kustom yang menutupi lapisan background. Sistem ini menggunakan `z-index` berlapis untuk memastikan efek partikel dan kursor tetap berfungsi di balik teks.

