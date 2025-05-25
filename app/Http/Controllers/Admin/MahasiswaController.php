<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class MahasiswaController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/mahasiswa');
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

    $response = Http::post('http://localhost:8080/mahasiswa', $request->all());

    if ($response->successful()) {
        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Berhasil menambahkan data.');
    } else {
        return back()->withErrors($response->json()['errors'])->withInput();
    }
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

        $response = Http::put("http://localhost:8080/mahasiswa/update/{$mahasiswa->npm_mhs}", $request->all());

        if ($response->successful()) {
            // Opsional: update local DB jika perlu
            $mahasiswa->update($request->all());

            return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil mengubah data.');
        } else {
            return back()->withErrors($response->json()['errors'] ?? ['error' => 'Gagal mengupdate data'])->withInput();
        }
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $response = Http::delete("http://localhost:8080/mahasiswa/delete/{$mahasiswa->npm_mhs}");

        if ($response->successful()) {
            // Opsional: hapus lokal jika perlu
            $mahasiswa->delete();

            return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil menghapus data.');
        } else {
            return back()->with('error', 'Gagal menghapus data.');
        }
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }
}