<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'hero_subtitle' => 'Halo, saya Theo. Seorang Mahasiswa IT & Fullstack Developer yang berfokus membangun sistem yang elegan, cepat, dan modern.',
        ]);
    }
}