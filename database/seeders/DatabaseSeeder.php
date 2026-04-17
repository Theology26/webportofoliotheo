<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Project;
use App\Models\SocialMedia;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin123'),
            ]);
        }

        // Profile
        if (Profile::count() === 0) {
            Profile::create([
                'hero_title_1' => 'Creative',
                'hero_title_highlight' => 'Development',
                'hero_title_outline' => 'made easy.',
                'hero_subtitle' => 'Solusi Digital Setiap Permasalahan Anda',
                'profile_photo' => 'profiles/nwL7ZWmm7vBHIs6zFqbZHD3RLGm6DXNAYwZYH5L3.jpg',
                'full_name' => 'Yosia Gracetheo Boimau',
                'job_title' => 'Fullstack Developer | Video Editor | Virtual Jockey',
                'birth_place_date' => 'Malang, 26 April 2026',
                'address' => 'Jl.S.Supriadi VII No 3',
                'email' => 'yosiagracetheo0@gmail.com',
                'instagram' => '@theoxcyro',
                'linkedin' => 'www.linkedin.com/in/yosia-gracetheo-boimau-919340211',
                'logo_image' => null,
                'cv_file' => 'files/TTeHFB63CmnC6frSLsZ5mZvGEBDQcAPnGlcGYucg.pdf',
            ]);
        }

        // Experiences
        if (Experience::count() === 0) {
            $experiences = [
                [
                    'year' => '2025',
                    'title' => 'Director Iklan Sekolah',
                    'description' => 'Memimpin produksi visual kampanye sekolah hingga sukses menaikkan rasio pendaftaran.',
                    'long_description' => 'Memimpin seluruh siklus produksi kampanye visual untuk sebuah institusi pendidikan di Kota Malang. Bertanggung jawab penuh mulai dari perumusan konsep kreatif, manajemen talenta lapangan, hingga arahan sinematografi visual akhir. Kampanye strategis ini secara signifikan meningkatkan brand awareness sekolah dan terbukti menghasilkan lonjakan konversi pada pendaftaran siswa baru. Sebuah pembuktian bahwa eksekusi visual yang presisi mampu menggerakkan audiens secara nyata',
                ],
                [
                    'year' => '2024 - Sekarang',
                    'title' => 'Virtual Jockey (VJ) GKJW Sukun',
                    'description' => 'Mengendalikan tata visual dan projection mapping secara live untuk berbagai event.',
                    'long_description' => 'Bertanggung jawab atas rekayasa visual (visual engineering) secara live untuk berbagai acara berskala besar di gereja. Memanfaatkan software multimedia profesional untuk merancang tata visual yang dinamis dan imersif. Pekerjaan ini menuntut fokus tinggi dan insting musikal untuk menyinkronkan ritme acara dengan tampilan grafis secara real-time, menciptakan atmosfer panggung yang sinergis dan tak terlupakan bagi audiens.',
                ],
                [
                    'year' => '2025 - Sekarang',
                    'title' => 'Video Editor',
                    'description' => 'Spesialis pasca-produksi untuk meracik raw footage menjadi narasi visual premium.',
                    'long_description' => 'Berperan sebagai spesialis pasca-produksi (post-production specialist) untuk mentransformasi rekaman mentah (raw footage) menjadi karya visual yang engaging. Menguasai alur kerja editing menggunakan perangkat lunak standar industri untuk keperluan color grading, transisi dinamis, hingga audio mixing. Berdedikasi penuh untuk menerjemahkan visi spesifik dan kemauan setiap pelanggan menjadi produk akhir berkualitas tinggi yang siap tayang.',
                ],
                [
                    'year' => '2025 - Sekarang',
                    'title' => 'Content Strategist',
                    'description' => 'Menganalisis tren dan merancang arsitektur konten digital beserta jadwal distribusinya.',
                    'long_description' => 'Merancang arsitektur kampanye digital dari tahap brainstorming ide hingga penyusunan content calendar. Menganalisis tren audiens untuk memformulasikan materi kreatif yang relevan dan berdampak. Posisi ini menuntut keseimbangan antara kreativitas visual dan pemikiran analitis dalam menyusun strategi publikasi, memastikan setiap konten yang mengudara memiliki objektif yang jelas dan mampu menghasilkan tingkat engagement yang optimal.',
                ],
            ];

            foreach ($experiences as $exp) {
                Experience::create($exp);
            }
        }

        // Projects
        if (Project::count() === 0) {
            $projects = [
                [
                    'title' => 'INTEGRASI VISI KOMPUTER DAN JARINGAN SARAF TIRUAN PADA SISTEM LOGISTIK CERDAS UNTUK EFISIENSI DISTRIBUSI MAKAN BERGIZI',
                    'description' => 'Sistem manajemen rantai pasok (supply chain) modern yang dirancang untuk melacak pergerakan armada dan inventaris secara presisi. Dibangun di atas fondasi backend Laravel dengan struktur database relasional tingkat tinggi. Sistem ini dilengkapi dengan dasbor analitik interaktif dan algoritma pelacakan real-time yang mampu mengurangi bottleneck distribusi, memberikan laporan instan, serta meminimalisir kesalahan input logistik secara otomatis.',
                    'image' => 'projects/qCGQGS0puFEHN27RajQdAEtLXLQrts37DsxQBGc1.jpg',
                    'tags' => 'Tailwind CSS, JavaScript, Custom CMS',
                ],
                [
                    'title' => 'Website Sparkling Cleaners Malang',
                    'description' => 'Membuatkan website untuk promosi dan pemesanan untuk UMKM Kota Malang',
                    'image' => 'projects/p95dNn8CFjVZeZrXm4gDvCzVhoVSezPsIQ7gYrBA.jpg',
                    'tags' => 'HTML, js, CSS,',
                ],
                [
                    'title' => 'PENGEMBANGAN OCR UNTUK WEBTOON KOREA',
                    'description' => "Pengembangan sistem OCR Webtoon Korea ini\r\nmenunjukkan hasil yang sangat positif dalam\r\nmengatasi keterbatasan bahasa dan menekan\r\npenggunaan situs ilegal.",
                    'image' => 'projects/RT860w8fBtUm6YRvvELcyTzcXv7mrEb1bOpPO4Kr.jpg',
                    'tags' => 'Python, Rest API, Easy OCR, YOLO, IO Paint',
                ],
            ];

            foreach ($projects as $proj) {
                Project::create($proj);
            }
        }

        // Social Media Links
        if (SocialMedia::count() === 0) {
            $socials = [
                [
                    'platform' => 'github',
                    'username' => 'Theology26',
                    'url' => 'https://github.com/Theology26',
                ],
                [
                    'platform' => 'linkedin',
                    'username' => 'Yosia Gracetheo Boimau',
                    'url' => 'https://www.linkedin.com/in/yosia-gracetheo-boimau-919340211/',
                ],
                [
                    'platform' => 'instagram',
                    'username' => '@theoxcyro',
                    'url' => 'https://www.instagram.com/theoxcyro?igsh=MTkwcGM1bDN5MGJybw==',
                ],
            ];

            foreach ($socials as $social) {
                SocialMedia::create($social);
            }
        }

        // Gallery / Activities
        if (Activity::count() === 0) {
            $activities = [
                ['image' => 'gallery/n4xRk6QUGjKt4xWPxf39Hsfbsoqz77EaYfibvwpH.jpg', 'caption' => null],
                ['image' => 'gallery/Ec1spoAa42HV5Yeg5mluqZD3L43bY1JZRRrvTa8W.jpg', 'caption' => null],
                ['image' => 'gallery/tZ06zD3rzJyOV0viuDWvpCkAyJ1sJMqojhxvhfuv.jpg', 'caption' => null],
                ['image' => 'gallery/rquGkFQOYegSmNKkg6BRsuNdiltrSe3T6iHG12Xz.jpg', 'caption' => null],
            ];

            foreach ($activities as $act) {
                Activity::create($act);
            }
        }
    }
}
