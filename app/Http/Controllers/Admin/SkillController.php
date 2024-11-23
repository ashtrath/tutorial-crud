<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::latest()->paginate(5);
        return view('admin.skills.index', compact('skills'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'category' => 'required',
            'icon_path' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $input = $request->all();

        if ($file = $request->file('icon_path')) {
            $filename = date('YmdHis').".".$file->getClientOriginalExtension();
            $file->move(public_path('/storage/skill_icons'), $filename);
            $input['icon_path'] = "$filename";
        }

        Skill::create($input);

        return redirect()->route('admin.skill.index')->with('success', 'Skill created successfully.');
    }

    public function show(Skill $skill)
    {
        return view('admin.skill.show', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|max:100',
            'category' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $imageName = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move(public_path('/storage/skill_icons'), $imageName);
            $input['icon_path'] = "$imageName";
        } else {
            unset($input['icon_path']);
        }

        $skill->update($input);

        return redirect()->route('admin.skill.index')->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        if ($skill['file']) {
            File::delete(public_path('storage/certificates/'.$skill['file']));
        }

        $skill->delete();
        return redirect()->route('admin.skill.index')->with('success', 'Skill deleted successfully');
    }
}
