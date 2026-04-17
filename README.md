# Web Portofolio Theo (Dynamic CMS & GitHub Tracking)

Selamat datang di repositori web portofolio Theo. Proyek ini dikembangkan dengan arsitektur Laravel 11 dan dirancang sebagai portofolio dinamis yang dilengkapi dengan sistem manajemen konten mandiri (CMS) serta integrasi data GitHub secara otomatis.

Dokumentasi ini disusun untuk memandu dalam konfigurasi teknis dan instalasi proyek secara lokal hingga dapat berjalan penuh.

---

## Fitur Utama Sistem

### 1. Strict iOS-Style Glassmorphism UI
Seluruh antarmuka pada rute landing page maupun di dalam Dashboard Admin dipoles menggunakan standar transparansi modern:
- Efek blur latar belakang tinggi (`backdrop-blur-3xl`) dengan warna semi-transparan yang gelap.
- Sudut panel dengan tingkat lengkungan presisi tinggi (`rounded-[2.5rem]`).
- Terdapat aksen garis tepi (border) tipis untuk menstimulasi refleksi kaca.

### 2. Efek Visual CSS & Animasi Latar
Halaman utama dirender dengan elemen visual yang tidak membebani pemrosesan JavaScript di posisi *background*:
- Background Aurora 3D dengan rendering skala dan rotasi organik murni melalui CSS.
- Simulasi meteor/bintang jatuh berkelanjutan dengan warna kustom (cyan) memadukan CSS gradients dan `@keyframes`.
- Canvas interaktif untuk efek konstelasi nodes/partikel yang dapat berinteraksi dengan pointer kursor.

### 3. Dynamic CMS & Admin Dashboard
Proyek ini mengadopsi backend fungsional sehingga seluruh data profil bukan merupakan hardcode HTML. Fitur Authentikasi standar mengamankan akses admin:
- Terdapat fitur manajemen Biodata, Profil, dan Tautan Sosial Media.
- Manajemen Riwayat Pengalaman Pekerjaan dengan dukungan Modals detail.
- Galeri Kegiatan dengan integrasi sistem penyimpanan *storage* Laravel.
- Manajemen daftar portofolio/Projek.

### 4. Integrasi GitHub API Real-time
Sistem memanfaatkan API GitHub menggunakan sebuah modul Service khusus (`GitHubService`):
- Melakukan *fetching* repositori publik berdasarkan username secara dinamis.
- Mengalkulasi penyebaran bahasa pemrograman (Tech Stack) yang digunakan pada keseluruhan repositori.
- Melindungi stabilitas *request* terhadap limit bawaan GitHub melalui pemanfaatan cache berdurasi 24 jam.

### 5. Dashboard Analytics
Dasbor admin menangkap statistik isi database secara realtime dan menerapkan dua struktur komputasi visual (disokong oleh modul *Chart.js*):
- Grafik Doughnut: Distribusi statistik bahasa pemrograman berdasar aktivitas di GitHub.
- Grafik Bar: Menampilkan komparasi peringkat 5 repositori teratas yang diukur dari perhitungan *Stars* dan ukuran repositori.

### 6. Auto-Generate ATS PDF CV
Dilengkapi dengan library pemroses PDF instan, setiap komponen aktif seperti Profil, Pengalaman, dan Sosial Media siap dirender secara dinamis menjadi dokumen PDF berformat profesional dalam sekali klik untuk keperluan melamar (unduh otomatis).

### 7. Interactive Detail Modals
Untuk menjamin retensi kecepatan akses pengguna di satu halaman (SPA experience), semua detail pada list Projek dan Pengalaman dirender secara sembunyi. Saat rincian kartu diklik pengunjung, maka kotak deskripsi panjang muncul mulus menggunakan fungsi modal kustom beserta efek *smooth zoom-in*.

---

## Panduan Menjalankan Sistem Secara Lokal

Tahapan instruksional ini disajikan untuk mempermudah eksekusi lingkungan pengembangan pada localhost komputer Anda.

### Prasyarat:
- Minimal spesifikasi PHP ^8.2.
- Composer terkalibrasi.
- Node.js (digunakan untuk memproses dependensi CSS Tailwind UI).
- Koneksi MySQL Database (Laragon, XAMPP, dsb) dalam keadaan hidup.

### Tahapan Instalasi:

1. Modul Git (Opsional jika proyek di-*clone*):
   ```bash
   git clone https://github.com/Theology26/webportofoliotheo.git
   cd webportofoliotheo
   ```

2. Konfigurasi Sistem Environment Utama:
   Duplikat file mentah environment standar:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` di teks editor. Hubungkan dengan kredensial database Anda masing-masing, misalnya:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=webportofoliotheo
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   
   Masih di dalam `.env`, atur pula integrasi server GitHub berikut ini guna menghindari error ketika server melakukan permintaan API pertama kalinya (opsional apabila akun bersifat privat):
   ```env
   GITHUB_USERNAME=Theology26
   GITHUB_TOKEN=masukkan_token_github_personal_opsional_disini
   ```

3. Unduh Keseluruhan Library Vendor:
   Buka terminal di root server web Anda dan instal barisan pustaka yang dibutuhkan:
   ```bash
   composer install
   npm install
   ```

4. Sinkronisasi Kriptografi Lokal & Folder Disk:
   Jalankan rutinitas internal keamanan Laravel:
   ```bash
   php artisan key:generate
   php artisan storage:link
   ```

5. Persiapkan Skema Data & Konten Database:
   Terdapat dua opsi untuk menyusun kerangka *database*:
   
   **Opsi A (Membangun Database Kosong Standar):**
   Gunakan struktur murni awal (hanya berisi tabel beserta kredensial akun admin).
   ```bash
   php artisan migrate --seed
   ```

   **Opsi B (Mengimpor Semua Data Konten Admin Secara Utuh):**
   Jika ingin langsung melihat *layout* produk akhir beserta tulisan, teks, rincian projek yang sudah disusun penuh, silakan navigasikan phpMyAdmin komputer Anda, lalu lakukan eksekusi *Import* pada fail `database_backup.sql` yang terletak di dalam akar map repositori ini ke target database.

6. Kompilasi Elemen Visual Tailwind CSS:
   Sintaks efek Glassmorphism belum utuh tanpa langkah perakitan file stylesheet akhir:
   ```bash
   npm run build
   ```

7. Inisialisasi Sistem Web:
   Tembak local port default untuk simulasi jalannya website:
   ```bash
   php artisan serve
   ```
   Halaman portofolio tamu kini sudah bisa dikunjungi di URL alamat: `http://localhost:8000`.

### Kredensial Akses Administrator
Ketik parameter penambahan URL `/login` (`http://localhost:8000/login`). Sistem telah digenerate beserta kredensial bawaan sehingga Anda tidak perlu mendaftar ulang:

- **Email Login:** admin@admin.com
- **Password:** admin123
