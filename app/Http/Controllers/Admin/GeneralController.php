<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General;
use App\Models\SocialLink;
use Illuminate\Http\Request;

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

    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'job_title' => 'required',
            'about' => 'required',
        ]);

        $general = General::first();

        if (!$general) {
            General::create($request->all());
        } else {
            $general->update($request->all());
        }

        return redirect()->route('admin.general.index')->with('success', 'General Information updated successfully.');
    }

    public function updateCV(Request $request)
    {
        $validated = $request->validate([
            'cv_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($file = $request->file('cv_file')) {
            $filename = date('YmdHis').".".$file->getClientOriginalExtension();
            $file->move(public_path('storage/cv'), $filename);
            $validated['cv_file'] = $filename;
        }

        $general = General::first();

        if ($general) {
            $general->update($validated);
        } else {
            return redirect()->back()->withErrors(['error' => 'General record not found.']);
        }

        return redirect()->route('admin.general.index')->with('success', 'CV uploaded successfully.');
    }

}
