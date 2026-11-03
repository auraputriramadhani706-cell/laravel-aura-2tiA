<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    private function rules(): array
    {
        return [
            'nama'        => 'required|string|max:100',
            'jabatan'     => 'required|string|max:100',
            'ringkasan'   => 'nullable|string',
            'email'       => 'nullable|email',
            'telepon'     => 'nullable|string|max:30',
            'alamat'      => 'nullable|string|max:255',
            'website'     => 'nullable|string|max:255',
            'pendidikan'  => 'nullable|string',
            'pengalaman'  => 'nullable|string',
            'skill'       => 'nullable|string',
            'sertifikasi' => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function index()
    {
        return view('cv.index', ['cvs' => Cv::latest()->get()]);
    }

    public function create()
    {
        return view('cv.form', ['cv' => new Cv]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        Cv::create($data);

        return redirect()->route('cv.index')->with('success', 'CV berhasil ditambahkan.');
    }

    public function show(Cv $cv)
    {
        return view('cv.show', compact('cv'));
    }

    public function edit(Cv $cv)
    {
        return view('cv.form', compact('cv'));
    }

    public function update(Request $request, Cv $cv)
    {
        $data = $request->validate($this->rules());

        if ($request->hasFile('foto')) {
            if ($cv->foto) {
                Storage::disk('public')->delete($cv->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        $cv->update($data);

        return redirect()->route('cv.index')->with('success', 'CV berhasil diperbarui.');
    }

    public function destroy(Cv $cv)
    {
        if ($cv->foto) {
            Storage::disk('public')->delete($cv->foto);
        }
        $cv->delete();

        return redirect()->route('cv.index')->with('success', 'CV berhasil dihapus.');
    }
}
