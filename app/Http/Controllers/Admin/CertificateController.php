<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::latest()->paginate(5);
        return view('admin.certificates.index', compact('certificates'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'initiated_by' => 'required|string|max:100',
            'initiated_at' => 'required|date',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:5120',
        ]);

        $input = $request->all();

        if ($file = $request->file('file')) {
            $filename = date('YmdHis').".".$file->getClientOriginalExtension();
            $file->move(public_path('/storage/certificates'), $filename);
            $input['file'] = "$filename";
        }

        Certificate::create($input);

        return redirect()->route('admin.certificate.index')->with('success', 'Certificate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'initiated_by' => 'required|string|max:100',
            'initiated_at' => 'required|date',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:5120',
        ]);

        $input = $request->all();

        if ($file = $request->file('file')) {
            $filename = date('YmdHis').".".$file->getClientOriginalExtension();
            $file->move(public_path('/storage/certificates'), $filename);
            $input['file'] = "$filename";
        } else {
            unset($input['file']);
        }

        $certificate->update($input);

        return redirect()->route('admin.certificate.index')->with('success', 'Certificate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        if ($certificate['file']) {
            File::delete(public_path('storage/certificates/'.$certificate['file']));
        }

        $certificate->delete();
        return redirect()->route('admin.certificate.index')->with('success', 'Certificate deleted successfully');
    }
}
