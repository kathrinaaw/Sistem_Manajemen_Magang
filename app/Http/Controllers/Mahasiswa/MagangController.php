<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use App\Models\Pembimbing;
use Barryvdh\DomPDF\Facade\Pdf;

class MagangController extends Controller
{
    public function index()
    {
        // Tampilkan semua data magang, tanpa filter
        $magang = Magang::with(['mahasiswa', 'perusahaan', 'pembimbing'])->get();

        return view('mahasiswa.magang.index', compact('magang'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $perusahaan = Perusahaan::all();
        $pembimbing = Pembimbing::all();

        return view('mahasiswa.magang.create', compact('mahasiswa', 'perusahaan', 'pembimbing'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_magang' => 'required|unique:magang,id_magang',
            'npm_mhs' => 'required|exists:mahasiswa,npm_mhs',
            'id_perusahaan' => 'required|exists:perusahaan,id_perusahaan',
            'nidn_pembimbing' => 'required|exists:pembimbing,nidn_pembimbing',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'status_magang' => 'required|string',
        ]);

        Magang::create($validated);

        return redirect()->route('mahasiswa.magang.index')->with('success', 'Data magang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $magang = Magang::with(['perusahaan', 'pembimbing', 'mahasiswa'])->findOrFail($id);
        return view('mahasiswa.magang.show', compact('magang'));
    }

    public function downloadPdf($id)
    {
        $magang = Magang::with(['mahasiswa', 'perusahaan', 'pembimbing'])->findOrFail($id);

        $pdf = Pdf::loadView('mahasiswa.magang.pdf', compact('magang'));

        return $pdf->download('pengajuan-magang-' . $magang->id_magang . '.pdf');
    }

}
