<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'link' => 'nullable|url',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $input = $request->all();

        if ($file = $request->file('image')) {
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/projects', $filename);
            $input['image'] = "$filename";
        }

        Project::create($input);

        return redirect()->route('admin.project.index')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'link' => 'nullable|url',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            if ($project->image && Storage::exists('public/projects/' . $project->image)) {
                Storage::delete('public/projects/' . $project->image); // Use Storage facade for file deletion
            };

            $file = $request->file('image');
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/projects', $filename);
            $input['image'] = "$filename";
        }

        $project->update($input);

        return redirect()->route('admin.project.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image && Storage::exists('public/projects/' . $project->image)) {
            Storage::delete('public/projects/' . $project->image);
        }

        $project->delete();
        return redirect()->route('admin.project.index')->with('success', 'Project deleted successfully');
    }
}
