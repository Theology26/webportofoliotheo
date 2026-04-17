<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;

// 1. Rute Halaman Depan (Public / Tanpa Login)
Route::get('/', function (\App\Services\GitHubService $githubService) {
    $profile = Profile::firstOrCreate([]);
    $experiences = \App\Models\Experience::orderBy('year', 'desc')->get();
    $projects = \App\Models\Project::latest()->get();
    $activities = \App\Models\Activity::latest()->get();
    $socialMedias = \App\Models\SocialMedia::all();
    
    $githubData = $githubService->fetchGitHubData();
    
    return view('welcome', compact('profile', 'experiences', 'projects', 'activities', 'socialMedias', 'githubData'));
});

// Form Diskusi Projek
Route::post('/project-consultation', [\App\Http\Controllers\ProjectConsultationController::class, 'store'])->name('contact.send');

// Auto-Generate CV
Route::get('/download-cv', function () {
    $profile = \App\Models\Profile::firstOrCreate([]);
    $experiences = \App\Models\Experience::orderBy('year', 'desc')->get();
    $projects = \App\Models\Project::latest()->get();
    $socialMedias = \App\Models\SocialMedia::all();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('cv_template', compact('profile', 'experiences', 'projects', 'socialMedias'));
    
    // Set custom format
    $pdf->setPaper('a4', 'portrait');

    return $pdf->download('CV_' . str_replace(' ', '_', $profile->full_name ?? 'Theo') . '.pdf');
})->name('cv.download');

// 2. Grup Rute Admin (Wajib Login)
Route::middleware('auth')->group(function () {
    
    // Dashboard Bawaan
    Route::get('/dashboard', function (\App\Services\GitHubService $githubService) {
        $stats = [
            'projects' => \App\Models\Project::count(),
            'experiences' => \App\Models\Experience::count(),
            'activities' => \App\Models\Activity::count(),
            'social_medias' => \App\Models\SocialMedia::count(),
        ];
        
        $githubData = $githubService->fetchGitHubData();
        
        return view('dashboard', compact('stats', 'githubData'));
    })->middleware(['verified'])->name('dashboard');

    // --- Rute Edit Akun Bawaan Breeze ---
    Route::get('/admin/portfolio', [PortfolioController::class, 'edit'])->name('admin.portfolio.edit');
    Route::patch('/admin/portfolio', [PortfolioController::class, 'update'])->name('admin.portfolio.update');

    // --- Rute CMS Baru ---
    Route::resource('admin/experiences', \App\Http\Controllers\Admin\ExperienceController::class)->names('admin.experiences');
    Route::resource('admin/projects', \App\Http\Controllers\Admin\ProjectController::class)->names('admin.projects');
    Route::resource('admin/activities', \App\Http\Controllers\Admin\ActivityController::class)->names('admin.activities');
    Route::resource('admin/social_medias', \App\Http\Controllers\Admin\SocialMediaController::class)->names('admin.social_medias');

    // --- Rute Edit Akun Bawaan Breeze ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Rute Autentikasi Login/Register Bawaan
require __DIR__.'/auth.php';
