<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    private $apiBaseUrl = 'http://localhost:8080';

    public function index()
    {
        // Cek apakah user sudah login dan role mahasiswa
        if (!AuthController::checkAuth()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        if (!AuthController::checkRole(['mahasiswa'])) {
            return redirect()->route('login')->with('error', 'Akses ditolak: Anda bukan mahasiswa');
        }

        $user = AuthController::getUser();
        
        // Ambil data mahasiswa dari API berdasarkan user yang login
        try {
            // Asumsi ada endpoint untuk get mahasiswa by user_id atau username
            $mahasiswaData = Http::get($this->apiBaseUrl . '/mahasiswa/' . $user['id_user'])->json();
            
            // Ambil data magang mahasiswa yang sedang login
            $magangData = Http::get($this->apiBaseUrl . '/magang?mahasiswa_id=' . $user['id_user'])->json();
            
        } catch (\Exception $e) {
            $mahasiswaData = null;
            $magangData = [];
        }

        return view('mahasiswa.dashboard', compact('user', 'mahasiswaData', 'magangData'));
    }
}