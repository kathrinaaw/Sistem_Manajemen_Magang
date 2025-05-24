<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerusahaanController extends Controller
{
    // Tampilkan daftar semua perusahaan
    public function index()
    {
        $perusahaanList = DB::table('perusahaan')
            ->select('*')
            ->orderBy('nama_perusahaan', 'asc')
            ->get();
            
        // Hitung jumlah mahasiswa yang magang di setiap perusahaan
        $perusahaanWithStats = $perusahaanList->map(function($perusahaan) {
            $jumlahMagang = DB::table('magang')
                ->where('id_perusahaan', $perusahaan->id_perusahaan)
                ->count();
                
            $perusahaan->jumlah_magang = $jumlahMagang;
            return $perusahaan;
        });
            
        return view('mahasiswa.perusahaan.index', [
            'perusahaanList' => $perusahaanWithStats,
            'totalPerusahaan' => $perusahaanList->count()
        ]);
    }
    
    // Tampilkan detail perusahaan
    public function show($id)
    {
        // Ambil data perusahaan berdasarkan ID
        $perusahaan = DB::table('perusahaan')
            ->where('id_perusahaan', $id)
            ->first();
            
        if (!$perusahaan) {
            return redirect()->route('mahasiswa.perusahaan.index')
                           ->with('error', 'Perusahaan tidak ditemukan');
        }
        
        // Ambil data mahasiswa yang sedang/pernah magang di perusahaan ini
        $daftarMagang = DB::table('v_magangg')
            ->where('id_perusahaan', $id)
            ->get();
            
        // Statistik perusahaan
        $stats = [
            'total_magang' => $daftarMagang->count(),
            'magang_aktif' => $daftarMagang->where('status_magang', 'aktif')->count(),
            'magang_selesai' => $daftarMagang->where('status_magang', 'selesai')->count(),
            'magang_pending' => $daftarMagang->where('status_magang', 'pending')->count(),
        ];
        
        return view('mahasiswa.perusahaan.show', [
            'perusahaan' => $perusahaan,
            'daftarMagang' => $daftarMagang,
            'stats' => $stats
        ]);
    }
    
}