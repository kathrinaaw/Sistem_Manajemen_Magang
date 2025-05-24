<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembimbing;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function index()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.pembimbing.index', compact('pembimbing'));
    }

    public function create()
    {
        return view('admin.pembimbing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn_pembimbing' => 'required',
            'nama_pembimbing' => 'required',
            'email_pembimbing' => 'required|email',
            'no_telp' => 'required',
        ]);

        Pembimbing::create($request->all());

        return redirect()->route('admin.pembimbing.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pembimbing = Pembimbing::findOrFail($id);
        return view('admin.pembimbing.edit', compact('pembimbing'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pembimbing' => 'required',
            'email_pembimbing' => 'required|email',
            'no_telp' => 'required',
        ]);

        $pembimbing = Pembimbing::findOrFail($id);
        $pembimbing->update($request->all());

        return redirect()->route('admin.pembimbing.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $pembimbing = Pembimbing::findOrFail($id);
        $pembimbing->delete();

        return redirect()->route('admin.pembimbing.index')->with('success', 'Data berhasil dihapus');
    }
}
