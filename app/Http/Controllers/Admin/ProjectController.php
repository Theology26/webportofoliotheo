<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Services\GitHubService;

class ProjectController extends Controller
{
    public function syncGithub(GitHubService $githubService)
    {
        $repos = $githubService->fetchAllRepositories();

        foreach ($repos as $repo) {
            Project::updateOrCreate(
                ['github_id' => $repo['github_id']],
                [
                    'title' => $repo['title'],
                    'description' => $repo['description'],
                    'github_url' => $repo['github_url'],
                    'tags' => $repo['tags'],
                    'image' => $repo['preview_image'], // Gunakan preview dari GitHub
                ]
            );
        }

        return redirect()->route('admin.projects.index')->with('success', 'GitHub Projects berhasil disinkronisasi!');
    }

    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'description' => 'required', 'image' => 'nullable|image', 'tags' => 'nullable']);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project ditambah');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate(['title' => 'required', 'description' => 'required', 'image' => 'nullable|image', 'tags' => 'nullable']);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            if ($project->image) Storage::delete('public/' . $project->image);
            $data['image'] = $request->file('image')->store('projects', 'public');
        }
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project diupdate');
    }

    public function destroy(Project $project)
    {
        if ($project->image) Storage::delete('public/' . $project->image);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project dihapus');
    }
}
