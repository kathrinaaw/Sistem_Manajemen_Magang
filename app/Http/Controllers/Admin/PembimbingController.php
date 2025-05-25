<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PembimbingController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('http://localhost:8080/pembimbing');

            if ($response->successful()) {
                $pembimbing = $response->json();
            } else {
                $pembimbing = [];
                session()->flash('error', 'Gagal mengambil data dari server.');
            }
        } catch (\Exception $e) {
            $pembimbing = [];
            session()->flash('error', 'Tidak dapat terhubung ke server.');
        }

        return view('admin.pembimbing.index', compact('pembimbing'));
    }

    public function create()
    {
        return view('admin.pembimbing.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn_pembimbing' => 'required',
            'nama_pembimbing' => 'required',
            'email' => 'required|email', // Ubah dari email_pembimbing ke email
            'no_telp' => 'required',
        ]);

        try {
            $response = Http::post('http://localhost:8080/pembimbing', $validated);

            if ($response->successful()) {
                return redirect()->route('admin.pembimbing.index')->with('success', 'Data berhasil ditambahkan');
            } else {
                $errors = $response->json()['errors'] ?? ['error' => 'Gagal menyimpan data'];
                return back()->withErrors($errors)->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Tidak dapat terhubung ke server.'])->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $response = Http::get("http://localhost:8080/pembimbing/$id");

            if ($response->successful()) {
                $responseData = $response->json();
                // Ambil data dari response (cek struktur response dari CI)
                $pembimbing = $responseData['data'] ?? $responseData;
                return view('admin.pembimbing.edit', compact('pembimbing'));
            } else {
                return redirect()->route('admin.pembimbing.index')->with('error', 'Data tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.pembimbing.index')->with('error', 'Tidak dapat terhubung ke server.');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pembimbing' => 'required',
            'email' => 'required|email', // Ubah dari email_pembimbing ke email
            'no_telp' => 'required',
        ]);

        try {
            $response = Http::put("http://localhost:8080/pembimbing/update/$id", $validated);

            if ($response->successful()) {
                return redirect()->route('admin.pembimbing.index')->with('success', 'Data berhasil diubah');
            } else {
                $errors = $response->json()['errors'] ?? ['error' => 'Gagal memperbarui data'];
                return back()->withErrors($errors)->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Tidak dapat terhubung ke server.'])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete("http://localhost:8080/pembimbing/delete/$id");

            if ($response->successful()) {
                return redirect()->route('admin.pembimbing.index')->with('success', 'Data berhasil dihapus');
            } else {
                return back()->with('error', 'Gagal menghapus data.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Tidak dapat terhubung ke server.');
        }
    }
}