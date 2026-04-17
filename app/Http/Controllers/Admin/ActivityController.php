<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.form');
    }

    public function store(Request $request)
    {
        $request->validate(['caption' => 'nullable', 'image' => 'required|image']);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }
        Activity::create($data);
        return redirect()->route('admin.activities.index')->with('success', 'Galeri ditambah');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.form', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate(['caption' => 'nullable', 'image' => 'nullable|image']);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            if ($activity->image) Storage::delete('public/' . $activity->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }
        $activity->update($data);
        return redirect()->route('admin.activities.index')->with('success', 'Galeri diupdate');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->image) Storage::delete('public/' . $activity->image);
        $activity->delete();
        return redirect()->route('admin.activities.index')->with('success', 'Galeri dihapus');
    }
}
