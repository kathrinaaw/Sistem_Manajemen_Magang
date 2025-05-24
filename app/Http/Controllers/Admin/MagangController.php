<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use App\Models\Perusahaan;

class MagangController extends Controller
{
    public function index()
    {
        // Ambil semua data magang beserta relasi mahasiswa, pembimbing, dan perusahaan
        $magang = Magang::with(['mahasiswa', 'pembimbing', 'perusahaan'])->get();
        return view('admin.magang.index', compact('magang'));
    }

    public function create()
    {
        // Ambil data untuk dropdown
        $mahasiswa = Mahasiswa::all();
        $pembimbing = Pembimbing::all();
        $perusahaan = Perusahaan::all();
        return view('admin.magang.create', compact('mahasiswa', 'pembimbing', 'perusahaan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_magang' => 'required|unique:magang,id_magang',
            'npm_mhs' => 'required|exists:mahasiswa,npm_mhs',
            'nidn_pembimbing' => 'required|exists:pembimbing,nidn_pembimbing',
            'id_perusahaan' => 'required|exists:perusahaan,id_perusahaan',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'status_magang' => 'required|string',
        ]);

        Magang::create($validated);
        return redirect()->route('admin.magang.index')->with('success', 'Data magang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $magang = Magang::findOrFail($id);
        $mahasiswa = Mahasiswa::all();
        $pembimbing = Pembimbing::all();
        $perusahaan = Perusahaan::all();
        return view('admin.magang.edit', compact('magang', 'mahasiswa', 'pembimbing', 'perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'npm_mhs' => 'required|exists:mahasiswa,npm_mhs',
            'nidn_pembimbing' => 'required|exists:pembimbing,nidn_pembimbing',
            'id_perusahaan' => 'required|exists:perusahaan,id_perusahaan',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'status_magang' => 'required|string',
        ]);

        $magang = Magang::findOrFail($id);
        $magang->update($validated);
        return redirect()->route('admin.magang.index')->with('success', 'Data magang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $magang = Magang::findOrFail($id);
        $magang->delete();
        return redirect()->route('admin.magang.index')->with('success', 'Data magang berhasil dihapus');
    }
}
