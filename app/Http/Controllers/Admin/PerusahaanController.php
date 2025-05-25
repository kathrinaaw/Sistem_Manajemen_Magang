<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PerusahaanController extends Controller
{
    protected $baseUrl = 'http://localhost:8080/perusahaan'; // Ganti jika beda

    public function index()
    {
        $response = Http::get($this->baseUrl);
        $perusahaan = $response->json();
        return view('admin.perusahaan.index', compact('perusahaan'));
    }

    public function create()
    {
        return view('admin.perusahaan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'email_perusahaan' => 'required|email'
        ]);

        Http::post($this->baseUrl, $validated);
        return redirect()->route('admin.perusahaan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $response = Http::get($this->baseUrl . '/' . $id);
        $perusahaan = $response->json();
        return view('admin.perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'email_perusahaan' => 'required|email'
        ]);

        Http::put($this->baseUrl . '/update/' . $id, $validated);
        return redirect()->route('admin.perusahaan.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        Http::delete($this->baseUrl . '/delete/' . $id);
        return redirect()->route('admin.perusahaan.index')->with('success', 'Data berhasil dihapus');
    }
}