<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
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

        return view('mahasiswa.pembimbing.index', [
            'pembimbingList' => collect($pembimbing),
            'totalPembimbing' => count($pembimbing),
        ]);
    }

    public function show($nidn)
{
    try {
        $response = Http::get("http://localhost:8080/pembimbing/{$nidn}");

        if ($response->successful()) {
            $pembimbing = $response->json();
        } else {
            abort(404, 'Data pembimbing tidak ditemukan.');
        }
    } catch (\Exception $e) {
        abort(500, 'Terjadi kesalahan saat mengambil data.');
    }

    return view('mahasiswa.pembimbing.show', compact('pembimbing'));
}

}
