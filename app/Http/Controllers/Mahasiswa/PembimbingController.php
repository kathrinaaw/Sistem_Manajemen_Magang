<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembimbingController extends Controller
{
    // Tampilkan daftar semua pembimbing
    public function index()
    {
        $pembimbingList = DB::table('pembimbing')
            ->select('*')
            ->orderBy('nama_pembimbing', 'asc')
            ->get();
            
        // Hitung jumlah mahasiswa yang dibimbing setiap pembimbing
        $pembimbingWithStats = $pembimbingList->map(function($pembimbing) {
            $jumlahBimbingan = DB::table('magang')
                ->where('nidn_pembimbing', $pembimbing->nidn_pembimbing)
                ->count();
                
            $bimbinganAktif = DB::table('magang')
                ->where('nidn_pembimbing', $pembimbing->nidn_pembimbing)
                ->where('status_magang', 'aktif')
                ->count();
                
            $pembimbing->jumlah_bimbingan = $jumlahBimbingan;
            $pembimbing->bimbingan_aktif = $bimbinganAktif;
            return $pembimbing;
        });
            
        return view('mahasiswa.pembimbing.index', [
            'pembimbingList' => $pembimbingWithStats,
            'totalPembimbing' => $pembimbingList->count()
        ]);
    }
    
    // Tampilkan detail pembimbing
    public function show($nidn)
    {
        // Ambil data pembimbing berdasarkan NIDN
        $pembimbing = DB::table('pembimbing')
            ->where('nidn_pembimbing', $nidn)
            ->first();
            
        if (!$pembimbing) {
            return redirect()->route('mahasiswa.pembimbing.index')
                           ->with('error', 'Pembimbing tidak ditemukan');
        }
        
        // Ambil data mahasiswa yang dibimbing oleh pembimbing ini
        $daftarBimbingan = DB::table('v_magangg')
            ->where('nidn_pembimbing', $nidn)
            ->orderBy('tgl_mulai', 'desc')
            ->get();
            
        // Statistik pembimbing
        $stats = [
            'total_bimbingan' => $daftarBimbingan->count(),
            'bimbingan_aktif' => $daftarBimbingan->where('status_magang', 'aktif')->count(),
            'bimbingan_selesai' => $daftarBimbingan->where('status_magang', 'selesai')->count(),
            'bimbingan_pending' => $daftarBimbingan->where('status_magang', 'pending')->count(),
        ];
        
        // Daftar perusahaan yang pernah bekerja sama dengan pembimbing ini
        $perusahaanKerjasama = DB::table('v_magangg')
            ->where('nidn_pembimbing', $nidn)
            ->select('id_perusahaan', 'nama_perusahaan')
            ->distinct()
            ->get();
        
        return view('mahasiswa.pembimbing.show', [
            'pembimbing' => $pembimbing,
            'daftarBimbingan' => $daftarBimbingan,
            'stats' => $stats,
            'perusahaanKerjasama' => $perusahaanKerjasama
        ]);
    }
}