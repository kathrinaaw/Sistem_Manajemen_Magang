<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm_mhs' => 'required|string|size:9|unique:mahasiswa,npm_mhs',
            'nama_mhs' => 'required|string|max:20',
            'prodi' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:50',
            'no_telp' => 'nullable|string|size:13',
            'email' => 'nullable|email|max:30',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'npm_mhs' => 'required|string|size:9|unique:mahasiswa,npm_mhs,' . $mahasiswa->npm_mhs . ',npm_mhs',
            'nama_mhs' => 'required|string|max:20',
            'prodi' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:50',
            'no_telp' => 'nullable|string|size:13',
            'email' => 'nullable|email|max:30',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    // (Opsional) method show kalau mau pakai view detail
    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }
}
