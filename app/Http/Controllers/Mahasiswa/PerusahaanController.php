<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PerusahaanController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('http://localhost:8080/perusahaan');

            if ($response->successful()) {
                $perusahaan = $response->json();
            } else {
                $perusahaan = [];
                session()->flash('error', 'Gagal mengambil data perusahaan dari server.');
            }
        } catch (\Exception $e) {
            $perusahaan = [];
            session()->flash('error', 'Tidak dapat terhubung ke server perusahaan.');
        }

        return view('mahasiswa.perusahaan.index', [
            'perusahaanList' => collect($perusahaan),
            'totalPerusahaan' => count($perusahaan),
        ]);
    }

    public function show($id)
    {
        try {
            // Ambil data perusahaan dari endpoint API
            $responsePerusahaan = Http::get("http://localhost:8080/perusahaan/{$id}");
            if (!$responsePerusahaan->successful()) abort(404);
            $perusahaan = $responsePerusahaan->json();

            // Ambil daftar magang terkait perusahaan
            $responseMagang = Http::get("http://localhost:8080/magang/perusahaan/{$id}");
            $daftarMagang = $responseMagang->successful() ? $responseMagang->json() : [];

            // Hitung statistik dari data magang
            $stats = [
                'total_magang' => count($daftarMagang),
                'magang_aktif' => collect($daftarMagang)->where('status_magang', 'aktif')->count(),
                'magang_selesai' => collect($daftarMagang)->where('status_magang', 'selesai')->count(),
                'magang_pending' => collect($daftarMagang)->where('status_magang', 'pending')->count(),
            ];

            return view('mahasiswa.perusahaan.show', compact('perusahaan', 'stats', 'daftarMagang'));
        } catch (\Exception $e) {
            abort(500, 'Gagal mengambil data dari API');
        }
    }
}
