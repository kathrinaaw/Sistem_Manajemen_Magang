<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil statistik untuk dashboard
        $stats = [
            'total_perusahaan' => DB::table('perusahaan')->count(),
            'total_pembimbing' => DB::table('pembimbing')->count(),
            'magang_aktif' => DB::table('magang')->where('status_magang', 'aktif')->count(),
            'total_mahasiswa' => DB::table('mahasiswa')->count()
        ];
        
        // Ambil data magang mahasiswa yang login (jika ada)
        // $npm_mahasiswa = auth()->user()->npm; // sesuaikan dengan sistem auth kamu
        
        return view('mahasiswa.dashboard', compact('stats'));
    }
}