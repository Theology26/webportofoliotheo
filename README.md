# Web Portofolio Theo (Dynamic CMS & GitHub Tracking)

Selamat datang di repositori web portofolio Theo. Proyek ini dikembangkan dengan arsitektur Laravel 11 dan dirancang sebagai portofolio dinamis yang dilengkapi dengan sistem manajemen konten mandiri (CMS) serta integrasi data GitHub secara otomatis.

Dokumentasi ini disusun untuk memandu konfigurasi teknis dan instalasi proyek secara lokal hingga dapat berjalan penuh.

---

## Fitur Utama Sistem

### 1. Strict iOS-Style Glassmorphism UI
Seluruh antarmuka pada halaman tamu (landing page) maupun Dashboard Admin dipoles menggunakan standar transparansi modern:
- Efek blur latar belakang tinggi (`backdrop-blur-3xl`) dengan warna semi-transparan gelap.
- Sudut panel dengan tingkat lengkungan presisi tinggi (`rounded-[2.5rem]`).
- Aksen garis tepi (border) tipis untuk menstimulasi refleksi kaca pada setiap komponen.

### 2. Efek Visual CSS dan Animasi Latar
Halaman utama dirender dengan elemen visual yang tidak membebani pemrosesan JavaScript di posisi background:
- Background Aurora 3D dengan rendering skala dan rotasi organik murni melalui CSS.
- Simulasi meteor/bintang jatuh berkelanjutan dengan warna kustom (cyan) memadukan CSS gradients dan `@keyframes`.
- Canvas interaktif untuk efek konstelasi nodes/partikel yang dapat berinteraksi dengan pointer kursor.

### 3. Dynamic CMS dan Admin Dashboard
Proyek ini mengadopsi backend fungsional sehingga seluruh data profil bukan merupakan hardcode HTML. Fitur Authentikasi standar mengamankan akses admin:
- Manajemen Biodata, Profil, dan Tautan Sosial Media.
- Manajemen Riwayat Pengalaman Pekerjaan dengan dukungan Modal detail (deskripsi panjang).
- Galeri Kegiatan dengan integrasi sistem penyimpanan storage Laravel.
- Manajemen daftar portofolio/Projek.

### 4. Integrasi GitHub API Real-time
Sistem memanfaatkan API GitHub menggunakan sebuah modul Service khusus (`GitHubService`):
- Melakukan fetching repositori publik secara dinamis.
- Mengalkulasi penyebaran bahasa pemrograman (Tech Stack) yang digunakan pada keseluruhan repositori.
- Melindungi stabilitas request terhadap limit bawaan GitHub melalui pemanfaatan cache berdurasi 24 jam.

### 5. Dashboard Analytics
Dasbor admin menangkap statistik isi database secara realtime dan menerapkan dua struktur visualisasi data (Chart.js):
- Grafik Doughnut: Distribusi statistik bahasa pemrograman berdasar aktivitas di GitHub.
- Grafik Bar: Menampilkan komparasi peringkat 5 repositori teratas berdasarkan perhitungan Stars dan ukuran repositori.

### 6. Auto-Generate ATS PDF CV
Dilengkapi dengan library pemroses PDF instan (DomPDF). Profil, Pengalaman, Kontak Sosial Media, dan komponen aktif lainnya dirender secara dinamis menjadi dokumen PDF berformat profesional dalam sekali klik untuk keperluan unduh otomatis.

### 7. Interactive Detail Modals
Setiap detail pada list Projek dan Pengalaman dirender secara tersembunyi. Saat kartu diklik pengunjung, kotak deskripsi panjang muncul menggunakan fungsi modal kustom dengan efek smooth zoom-in.

---

## Panduan Menjalankan Sistem Secara Lokal

### Prasyarat:
- PHP versi 8.2 atau lebih baru.
- Composer (Package Manager PHP).
- Node.js dan NPM (untuk memproses dependensi Tailwind CSS).
- MySQL dalam keadaan aktif (melalui Laragon, XAMPP, atau sejenisnya).

### Tahapan Instalasi:

1. Clone Repository:
   ```bash
   git clone https://github.com/Theology26/webportofoliotheo.git
   cd webportofoliotheo
   ```

2. Konfigurasi Environment:
   Duplikat file environment standar:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` dan sesuaikan koneksi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=webportofoliotheo
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Install Dependencies:
   ```bash
   composer install
   npm install
   ```

4. Generate App Key dan Link Storage:
   ```bash
   php artisan key:generate
   php artisan storage:link
   ```

5. Migrasi Database dan Seeding Data:
   Perintah berikut akan membangun seluruh struktur tabel database sekaligus mengisi data awal (profil, pengalaman, projek, galeri, sosial media, dan akun admin):
   ```bash
   php artisan migrate --seed
   ```

6. Kompilasi Asset Tailwind CSS:
   ```bash
   npm run build
   ```

7. Jalankan Server:
   ```bash
   php artisan serve
   ```
   Buka `http://localhost:8000` di browser.

### Kredensial Akses Administrator
Akses halaman login di `http://localhost:8000/login` menggunakan kredensial berikut:

| Field    | Nilai              |
|----------|--------------------|
| Email    | admin@admin.com    |
| Password | admin123           |
