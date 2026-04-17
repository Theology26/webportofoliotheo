<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile; // Pastikan ini ditambahkan

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data profil pertama (atau buat baru jika tidak ada)
        $profile = Profile::firstOrCreate([]); 

        return view('welcome', compact('profile'));
    }
}