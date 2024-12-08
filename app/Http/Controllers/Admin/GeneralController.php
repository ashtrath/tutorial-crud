<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generals = General::first();
        $social_links = SocialLink::all();

        return view('admin.general.index', compact('generals', 'social_links'));
    }

    /**
     * Update General information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'job_title' => 'required',
            'about' => 'required',
        ]);

        General::updateOrCreate([], $request->all());

        return redirect()->route('admin.general.index')->with('success', 'General Information updated successfully.');
    }

    /**
     * Handle image file uploads.
     */
    public function updateImage(Request $request)
    {
        $validated = $request->validate([
            'hero_image' => 'nullable|mimes:png,jpg,jpeg,webp|max:5120',
        ]);

        if ($file = $request->file('hero_image')) {
            $filename = date('YmdHis').".".$file->getClientOriginalExtension();
            $file->storeAs('public/hero_images', $filename);
            $validated['hero_image'] = $filename;
        }

        $general = General::first();
        if (!$general) {
            return redirect()->back()->withErrors(['error' => 'General record not found.']);
        }

        $general->update($validated);

        return redirect()->route('admin.general.index')->with('success', 'Hero Image uploaded successfully.');
    }

    /**
     * Handle CV file uploads.
     */
    public function updateCV(Request $request)
    {
        $validated = $request->validate([
            'cv_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($file = $request->file('cv_file')) {
            $filename = date('YmdHis').".".$file->getClientOriginalExtension();
            $file->storeAs('public/cv', $filename);
            $validated['cv_file'] = $filename;
        }

        $general = General::first();
        if (!$general) {
            return redirect()->back()->withErrors(['error' => 'General record not found.']);
        }

        $general->update($validated);

        return redirect()->route('admin.general.index')->with('success', 'CV uploaded successfully.');
    }
}
