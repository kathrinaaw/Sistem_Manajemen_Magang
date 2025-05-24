<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::all();
        return view('admin.perusahaan.index', compact('perusahaan'));
    }

    public function create()
    {
        return view('admin.perusahaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'email_perusahaan' => 'required|email'
        ]);

        Perusahaan::create($request->all());

        return redirect()->route('admin.perusahaan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('admin.perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'email_perusahaan' => 'required|email'
        ]);

        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->update($request->all());

        return redirect()->route('admin.perusahaan.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        return redirect()->route('admin.perusahaan.index')->with('success', 'Data berhasil dihapus');
    }
}
