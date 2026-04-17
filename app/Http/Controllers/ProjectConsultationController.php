<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectConsultationMail;

class ProjectConsultationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'project_list' => 'required|string'
        ]);

        $data = $request->only('name', 'sender_email', 'project_list');

        // Sending email to the hardcoded owner email. They must configure .env Mail settings.
        try {
            Mail::to('yosiagracetheo0@gmail.com')->send(new ProjectConsultationMail($data));
        } catch (\Exception $e) {
            // Log if email fails (often because no SMTP configured locally)
            \Log::error('Mail could not be sent: ' . $e->getMessage());
        }

        return redirect('/#contact')->with('contact_success', 'Terima kasih! Pesan dan daftar projek Anda telah dikirim ke email saya. Saya akan segera menghubungi Anda.');
    }
}
