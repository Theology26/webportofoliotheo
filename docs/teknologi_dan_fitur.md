# Dokumentasi Teknis Project: Web Portofolio Theo

Project ini adalah sebuah **Full CMS (Content Management System)** Portofolio yang dibangun menggunakan Framework **Laravel**.

---

## 1. Bahasa Pemrograman & Teknologi
Project ini menggunakan kombinasi teknologi modern (*Tech Stack*) sebagai berikut:

- **PHP (Version 8.x)**: Bahasa pemrograman utama untuk logika *Backend* (server). Digunakan untuk memproses formulir, mengatur akses login admin, dan mengambil data dari database.
- **JavaScript (Vanilla & Alpine.js)**: Digunakan untuk efek visual *Frontend*. 
  - *Vanilla JS*: Digunakan untuk efek jejak kursor (trail).
  - *Alpine.js*: Digunakan untuk interaktivitas komponen (seperti dropdown navbar).
- **HTML (Blade Templating)**: Laravel menggunakan engine `Blade` yang memungkinkan kita mencampur kode PHP ke dalam HTML dengan rapi (misalnya untuk perulangan `@foreach`).
- **CSS (Tailwind CSS)**: Framework CSS yang digunakan untuk styling. Semua desain *Glassmorphism* dan *Dark Mode* dibuat menggunakan kelas-kelas dari Tailwind.
- **SQL (Relational Database)**: Digunakan untuk menyimpan data profil, projek, pengalaman, dan sosial media.

---

## 2. Fitur Utama CMS
Project ini memiliki fitur lengkap yang bisa dikelola melalui panel admin:

1. **Sistem Autentikasi**: Login aman khusus untuk Admin (Theo) sehingga orang lain tidak bisa mengubah isi portofolio.
2. **Manajemen Konten (CRUD)**:
   - **Profil & About Me**: Mengubah teks Hero, foto profil 3D, Nama, dan Job Title.
   - **Social Media**: Menambahkan link sosmed sebanyak mungkin (Github, IG, dll) dengan ikon otomatis.
   - **Projects**: Upload karya terbaru lengkap dengan gambar dan tag teknologi.
   - **Experiences**: Mencatat riwayat karir/pekerjaan.
   - **Gallery**: Menampilkan foto kegiatan.
3. **Discuss a Project (Email System)**: Form interaktif di halaman depan yang akan mengirimkan rincian konsultasi projek langsung ke email Theo.
4. **Dashboard Statistik**: Ringkasan jumlah data projek dan konten lainnya dalam bentuk kartu visual.
5. **3D Glassmorphism UI**: Desain futuristik dengan efek transparansi, blur, dan animasi kursor (jejak air/kaca).

---

## 3. Struktur Folder Penting
- `app/Http/Controllers/`: Logika utama website (Backend).
- `app/Models/`: Struktur tabel database.
- `resources/views/`: Semua file tampilan (HTML/Blade).
  - `welcome.blade.php`: Halaman depan utama.
  - `admin/`: Folder menu-menu pengelolaan admin.
- `resources/css/app.css`: Tempat penyimpanan *Custom Styling* (Glow, Grid Background, Glass).
- `routes/web.php`: Pengaturan alamat URL website.
- `storage/app/public/`: Tempat tersimpannya foto profil dan gambar projek yang Anda upload.

---

*Dokumentasi ini dibuat untuk memudahkan Theo dalam memahami isi dan cara kerja project portofolionya.*
