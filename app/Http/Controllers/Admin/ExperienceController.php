<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::all();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.form');
    }

    public function store(Request $request)
    {
        $request->validate(['year' => 'required', 'title' => 'required', 'description' => 'required', 'long_description' => 'nullable']);
        Experience::create($request->all());
        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman ditambah');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.form', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $request->validate(['year' => 'required', 'title' => 'required', 'description' => 'required', 'long_description' => 'nullable']);
        $experience->update($request->all());
        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman diupdate');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman dihapus');
    }
}
