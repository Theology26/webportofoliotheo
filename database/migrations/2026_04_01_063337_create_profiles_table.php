<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // Teks Atas (misal: "Digital")
            $table->string('hero_title_1')->nullable()->default('Digital'); 
            // Kata yang menyala (misal: "solutions")
            $table->string('hero_title_highlight')->nullable()->default('solutions'); 
            // Kata yang outline (misal: "made easy.")
            $table->string('hero_title_outline')->nullable()->default('made easy.'); 
            // Subtitle deskripsi
            $table->text('hero_subtitle')->nullable(); 
            // Path foto profil yang diunggah
            $table->string('profile_photo')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};