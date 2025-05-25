<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class MagangController extends Controller
{
    protected $apiUrl = 'http://localhost:8080/magang';
    protected $mahasiswaApiUrl = 'http://localhost:8080/mahasiswa';
    protected $perusahaanApiUrl = 'http://localhost:8080/perusahaan';
    protected $pembimbingApiUrl = 'http://localhost:8080/pembimbing';

    public function index()
    {
        try {
            $response = Http::get($this->apiUrl);

            if ($response->successful()) {
                $magang = $response->json();
            } else {
                $magang = [];
                session()->flash('error', 'Gagal mengambil data magang dari server.');
            }
        } catch (\Exception $e) {
            $magang = [];
            session()->flash('error', 'Tidak dapat terhubung ke server: ' . $e->getMessage());
        }

        return view('mahasiswa.magang.index', compact('magang'));
    }

    public function create()
    {
        try {
            // Ambil data dropdown dari API
            $mahasiswa = [];
            $perusahaan = [];
            $pembimbing = [];

            // Ambil data mahasiswa
            try {
                $mahasiswaResponse = Http::get($this->mahasiswaApiUrl);
                if ($mahasiswaResponse->successful()) {
                    $mahasiswa = $mahasiswaResponse->json();
                }
            } catch (\Exception $e) {
                // Diabaikan saja error ini
            }

            // Ambil data perusahaan
            try {
                $perusahaanResponse = Http::get($this->perusahaanApiUrl);
                if ($perusahaanResponse->successful()) {
                    $perusahaan = $perusahaanResponse->json();
                }
            } catch (\Exception $e) {
                // Diabaikan saja error ini
            }

            // Ambil data pembimbing
            try {
                $pembimbingResponse = Http::get($this->pembimbingApiUrl);
                if ($pembimbingResponse->successful()) {
                    $pembimbing = $pembimbingResponse->json();
                }
            } catch (\Exception $e) {
                // Diabaikan saja error ini
            }

            return view('mahasiswa.magang.create', compact('mahasiswa', 'perusahaan', 'pembimbing'));
            
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.magang.index')
                           ->with('error', 'Tidak dapat terhubung ke server: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm_mhs' => 'required|string',
            'nidn_pembimbing' => 'required|string',
            'id_perusahaan' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'status_magang' => 'required|in:mbkm,mandiri',
        ], [
            'npm_mhs.required' => 'NPM Mahasiswa wajib diisi',
            'nidn_pembimbing.required' => 'NIDN Pembimbing wajib diisi',
            'id_perusahaan.required' => 'ID Perusahaan wajib diisi',
            'id_perusahaan.numeric' => 'ID Perusahaan harus berupa angka',
            'tgl_mulai.required' => 'Tanggal mulai wajib diisi',
            'tgl_mulai.date' => 'Format tanggal mulai tidak valid',
            'tgl_selesai.required' => 'Tanggal selesai wajib diisi',
            'tgl_selesai.date' => 'Format tanggal selesai tidak valid',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai',
            'status_magang.required' => 'Status magang wajib dipilih',
            'status_magang.in' => 'Status magang harus MBKM atau Mandiri',
        ]);

        try {
            $response = Http::post($this->apiUrl, $validated);

            if ($response->successful()) {
                return redirect()->route('mahasiswa.magang.index')->with('success', 'Data magang berhasil ditambahkan');
            } else {
                $errorMessage = 'Gagal menyimpan data magang';
                
                // Coba ambil pesan error dari response
                if ($response->json() && isset($response->json()['message'])) {
                    $errorMessage = $response->json()['message'];
                }
                
                return back()->withErrors(['error' => $errorMessage])->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Tidak dapat terhubung ke server: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                $magang = $response->json();
                return view('mahasiswa.magang.show', compact('magang'));
            } else {
                return redirect()->route('mahasiswa.magang.index')->with('error', 'Data magang tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.magang.index')->with('error', 'Tidak dapat terhubung ke server: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                $magang = $response->json();
                
                // Ambil data dropdown untuk edit
                $mahasiswa = [];
                $perusahaan = [];
                $pembimbing = [];

                try {
                    $mahasiswaResponse = Http::get($this->mahasiswaApiUrl);
                    if ($mahasiswaResponse->successful()) {
                        $mahasiswa = $mahasiswaResponse->json();
                    }
                } catch (\Exception $e) {
                    // Diabaikan saja error ini
                }

                try {
                    $perusahaanResponse = Http::get($this->perusahaanApiUrl);
                    if ($perusahaanResponse->successful()) {
                        $perusahaan = $perusahaanResponse->json();
                    }
                } catch (\Exception $e) {
                    // Diabaikan saja error ini
                }

                try {
                    $pembimbingResponse = Http::get($this->pembimbingApiUrl);
                    if ($pembimbingResponse->successful()) {
                        $pembimbing = $pembimbingResponse->json();
                    }
                } catch (\Exception $e) {
                    // Diabaikan saja error ini
                }

                return view('mahasiswa.magang.edit', compact('magang', 'mahasiswa', 'perusahaan', 'pembimbing'));
            } else {
                return redirect()->route('mahasiswa.magang.index')->with('error', 'Data magang tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.magang.index')->with('error', 'Tidak dapat terhubung ke server: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'npm_mhs' => 'required|string',
            'nidn_pembimbing' => 'required|string',
            'id_perusahaan' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'status_magang' => 'required|in:mbkm,mandiri',
        ], [
            'npm_mhs.required' => 'NPM Mahasiswa wajib diisi',
            'nidn_pembimbing.required' => 'NIDN Pembimbing wajib diisi',
            'id_perusahaan.required' => 'ID Perusahaan wajib diisi',
            'id_perusahaan.numeric' => 'ID Perusahaan harus berupa angka',
            'tgl_mulai.required' => 'Tanggal mulai wajib diisi',
            'tgl_mulai.date' => 'Format tanggal mulai tidak valid',
            'tgl_selesai.required' => 'Tanggal selesai wajib diisi',
            'tgl_selesai.date' => 'Format tanggal selesai tidak valid',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai',
            'status_magang.required' => 'Status magang wajib dipilih',
            'status_magang.in' => 'Status magang harus MBKM atau Mandiri',
        ]);

        try {
            // Sesuaikan dengan endpoint CodeIgniter Anda
            $response = Http::put("{$this->apiUrl}/{$id}", $validated);

            if ($response->successful()) {
                return redirect()->route('mahasiswa.magang.index')->with('success', 'Data magang berhasil diperbarui');
            } else {
                $errorMessage = 'Gagal memperbarui data magang';
                
                if ($response->json() && isset($response->json()['message'])) {
                    $errorMessage = $response->json()['message'];
                }
                
                return back()->withErrors(['error' => $errorMessage])->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Tidak dapat terhubung ke server: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            // Sesuaikan dengan endpoint CodeIgniter Anda
            $response = Http::delete("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                return redirect()->route('mahasiswa.magang.index')->with('success', 'Data magang berhasil dihapus');
            } else {
                $errorMessage = 'Gagal menghapus data magang';
                
                if ($response->json() && isset($response->json()['message'])) {
                    $errorMessage = $response->json()['message'];
                }
                
                return back()->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Tidak dapat terhubung ke server: ' . $e->getMessage());
        }
    }

    public function downloadPdf($id)
    {
        try {
            // Ambil data magang dari API
            $response = Http::get("{$this->apiUrl}/{$id}");
            
            if (!$response->successful()) {
                return redirect()->route('mahasiswa.magang.index')
                    ->with('error', 'Data magang tidak ditemukan');
            }

            $magang = $response->json();
            
            // Convert array to object untuk compatibility dengan view
            $magang = json_decode(json_encode($magang));

            $pdf = Pdf::loadView('mahasiswa.magang.pdf', compact('magang'));

            return $pdf->download('pengajuan-magang-' . $magang->id_magang . '.pdf');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.magang.index')
                ->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }
}