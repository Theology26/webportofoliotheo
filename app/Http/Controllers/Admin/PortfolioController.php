<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile; // Wajib dipanggil untuk akses database portofolio
use Illuminate\Support\Facades\Storage; // Wajib dipanggil untuk fitur upload gambar

class PortfolioController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrCreate([]);
        return view('admin.portfolio.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        // Validasi agar data yang dimasukkan aman
        $request->validate([
            'hero_title_1' => 'nullable|string|max:255',
            'hero_title_highlight' => 'nullable|string|max:255',
            'hero_title_outline' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', 
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:5120', 
            'cv_file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'full_name' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'birth_place_date' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
        ]);

        $profile = Profile::firstOrCreate([]);

        // Handle File Upload (Foto Profil) dengan WebP Compressing
        if ($request->hasFile('profile_photo')) {
            if ($profile->profile_photo) {
                Storage::delete('public/' . $profile->profile_photo);
            }
            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('profile_photo'));
                $filename = 'profiles/' . uniqid() . '.webp';
                // Compress & Save as WebP
                $image->toWebp(75)->save(storage_path('app/public/' . $filename));
                $profile->profile_photo = $filename;
            } catch (\Exception $e) {
                // Fallback jika tidak support webp/gd
                $path = $request->file('profile_photo')->store('profiles', 'public');
                $profile->profile_photo = $path;
            }
        }

        // Handle Logo Upload (Bisa SVG atau Gambar biasa)
        if ($request->hasFile('logo_image')) {
            if ($profile->logo_image) {
                Storage::delete('public/' . $profile->logo_image);
            }
            $extension = $request->file('logo_image')->getClientOriginalExtension();
            if(strtolower($extension) === 'svg') {
                $pathLogo = $request->file('logo_image')->store('profiles', 'public');
                $profile->logo_image = $pathLogo;
            } else {
                try {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($request->file('logo_image'));
                    $filename = 'profiles/logo_' . uniqid() . '.webp';
                    $image->toWebp(85)->save(storage_path('app/public/' . $filename));
                    $profile->logo_image = $filename;
                } catch (\Exception $e) {
                    $pathLogo = $request->file('logo_image')->store('profiles', 'public');
                    $profile->logo_image = $pathLogo;
                }
            }
        }

        // Handle CV Upload
        if ($request->hasFile('cv_file')) {
            if ($profile->cv_file) {
                Storage::delete('public/' . $profile->cv_file);
            }
            $pathCv = $request->file('cv_file')->store('files', 'public');
            $profile->cv_file = $pathCv;
        } elseif ($request->has('delete_cv') && $request->delete_cv == '1') {
            // Handle CV Delete
            if ($profile->cv_file) {
                Storage::delete('public/' . $profile->cv_file);
                $profile->cv_file = null;
            }
        }

        // Simpan semua teks yang diubah
        $profile->hero_title_1 = $request->hero_title_1;
        $profile->hero_title_highlight = $request->hero_title_highlight;
        $profile->hero_title_outline = $request->hero_title_outline;
        $profile->hero_subtitle = $request->hero_subtitle;
        $profile->full_name = $request->full_name;
        $profile->job_title = $request->job_title;
        $profile->birth_place_date = $request->birth_place_date;
        $profile->address = $request->address;
        $profile->email = $request->email;
        $profile->save();

        return redirect()->back()->with('status', 'Portofolio berhasil diperbarui!');
    }
}