<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.social_links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url|unique:social_links',
            'icon' => 'required',
        ]);

        SocialLink::create($request->all());

        return redirect()->route('admin.about.index')->with('success', 'Social Link created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialLink $social_link)
    {
        return view('admin.social_links.edit', compact($social_link));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $social_link)
    {
        $request->validate([
            'link' => 'required|url|unique:social_links',
            'icon' => 'required',
        ]);

        $social_link->update($request->all());

        return redirect()->route('admin.about.index')->with('success', 'Social Link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $social_link)
    {
        $social_link->delete();
        return redirect()->route('admin.about.index')->with('success', 'Social Link deleted successfully');
    }
}
