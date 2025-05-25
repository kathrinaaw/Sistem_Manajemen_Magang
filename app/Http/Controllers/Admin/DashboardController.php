<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    private $apiBaseUrl = 'http://localhost:8080';

    public function index()
    {
        // Cek apakah user sudah login dan role admin
        if (!AuthController::checkAuth()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        if (!AuthController::checkRole(['admin'])) {
            return redirect()->route('login')->with('error', 'Akses ditolak: Anda bukan admin');
        }

        $user = AuthController::getUser();
        
        // Ambil data statistik dari API (opsional)
        try {
            $totalMahasiswa = Http::get($this->apiBaseUrl . '/mahasiswa')->json();
            $totalPembimbing = Http::get($this->apiBaseUrl . '/pembimbing')->json();
            $totalPerusahaan = Http::get($this->apiBaseUrl . '/perusahaan')->json();
            $totalMagang = Http::get($this->apiBaseUrl . '/magang')->json();

            $stats = [
                'mahasiswa' => is_array($totalMahasiswa) ? count($totalMahasiswa) : 0,
                'pembimbing' => is_array($totalPembimbing) ? count($totalPembimbing) : 0,
                'perusahaan' => is_array($totalPerusahaan) ? count($totalPerusahaan) : 0,
                'magang' => is_array($totalMagang) ? count($totalMagang) : 0,
            ];
        } catch (\Exception $e) {
            $stats = [
                'mahasiswa' => 0,
                'pembimbing' => 0,
                'perusahaan' => 0,
                'magang' => 0,
            ];
        }

        return view('admin.dashboard', compact('user', 'stats'));
    }
}