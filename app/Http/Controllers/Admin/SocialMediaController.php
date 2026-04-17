<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedias = SocialMedia::all();
        return view('admin.social_medias.index', compact('socialMedias'));
    }

    public function create()
    {
        return view('admin.social_medias.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required',
            'username' => 'required',
            'url' => 'required|url',
        ]);
        SocialMedia::create($request->all());
        return redirect()->route('admin.social_medias.index')->with('success', 'Social Media berhasil ditambah');
    }

    public function edit(SocialMedia $socialMedia)
    {
        return view('admin.social_medias.form', compact('socialMedia'));
    }

    public function update(Request $request, SocialMedia $socialMedia)
    {
        $request->validate([
            'platform' => 'required',
            'username' => 'required',
            'url' => 'required|url',
        ]);
        $socialMedia->update($request->all());
        return redirect()->route('admin.social_medias.index')->with('success', 'Social Media berhasil diupdate');
    }

    public function destroy(SocialMedia $socialMedia)
    {
        $socialMedia->delete();
        return redirect()->route('admin.social_medias.index')->with('success', 'Social Media berhasil dihapus');
    }
}
