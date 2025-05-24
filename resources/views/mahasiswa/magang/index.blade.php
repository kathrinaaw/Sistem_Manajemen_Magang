@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                     style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-clipboard-list text-white fs-4"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Daftar Magang</h2>
                <p class="text-muted">Berikut adalah daftar pengajuan magang</p>
            </div>

            <!-- Flash Success -->
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tombol Tambah -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('mahasiswa.magang.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-2"></i>Tambah Magang
                </a>
            </div>

            <!-- Table Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Mahasiswa</th>
                                    <th>Perusahaan</th>
                                    <th>Pembimbing</th>
                                    <th>Tgl Mulai</th>
                                    <th>Tgl Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($magang as $m)
                                    <tr>
                                        <td class="text-center">{{ $m->id_magang }}</td>
                                        <td>{{ $m->mahasiswa->nama_mhs ?? '-' }}</td>
                                        <td>{{ $m->perusahaan->nama_perusahaan ?? '-' }}</td>
                                        <td>{{ $m->pembimbing->nama_pembimbing ?? '-' }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($m->tgl_mulai)->format('d M Y') }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($m->tgl_selesai)->format('d M Y') }}</td>
                                        <td class="text-center">{{ $m->status_magang }}</td>
                                        <!-- Opsi 2: Download PDF -->
                                        <td class="text-center">
                                            <a href="{{ route('mahasiswa.magang.downloadPdf', $m->id_magang) }}" 
                                            class="btn btn-danger shadow-sm" title="Download PDF">
                                            Download PDF
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="fas fa-info-circle me-2"></i>Belum ada data magang.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Klik ikon PDF untuk mengunduh bukti pengajuan magang
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
