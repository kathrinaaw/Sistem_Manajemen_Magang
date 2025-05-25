@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Tombol Kembali -->
    <a href="{{ route('admin.dashboard') }}" 
       class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>

    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle me-3" 
                     style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-briefcase text-white"></i>
                </div>
                <div>
                    <h1 class="fw-bold text-dark mb-1">Data Magang</h1>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.magang.create') }}" 
               class="btn btn-lg px-4 py-2 fw-semibold shadow-sm"
               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                <i class="fas fa-plus me-2"></i>Tambah Magang
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Data Table Card -->
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-semibold text-dark mb-0">
                    <i class="fas fa-table me-2" style="color: #667eea;"></i>
                    Daftar Magang
                </h5>
                <span class="badge rounded-pill px-3 py-2" 
                      style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    {{ count($magang) }} Data
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            @if(count($magang) > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <tr>
                            <th class="text-white fw-semibold py-3 px-4">ID</th>
                            <th class="text-white fw-semibold py-3 px-4">Mahasiswa</th>
                            <th class="text-white fw-semibold py-3 px-4">NPM</th>
                            <th class="text-white fw-semibold py-3 px-4">Perusahaan</th>
                            <th class="text-white fw-semibold py-3 px-4">Pembimbing</th>
                            <th class="text-white fw-semibold py-3 px-4">Tgl Mulai</th>
                            <th class="text-white fw-semibold py-3 px-4">Tgl Selesai</th>
                            <th class="text-white fw-semibold py-3 px-4">Status</th>
                            <th class="text-white fw-semibold py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($magang as $m)
                        <tr class="table-row-hover">
                            <td class="py-3 px-4 fw-semibold">{{ $m['id_magang'] ?? '-' }}</td>
                            <td class="py-3 px-4">
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold">{{ $m['mahasiswa']['nama_mhs'] ?? '-' }}</span>
                                    <small class="text-muted">{{ $m['mahasiswa']['prodi'] ?? '-' }}</small>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <code class="bg-light px-2 py-1 rounded">{{ $m['npm_mhs'] ?? '-' }}</code>
                            </td>
                            <td class="py-3 px-4">
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold">{{ $m['perusahaan']['nama_perusahaan'] ?? '-' }}</span>
                                    <small class="text-muted">{{ substr($m['perusahaan']['alamat'] ?? '-', 0, 30) }}{{ strlen($m['perusahaan']['alamat'] ?? '') > 30 ? '...' : '' }}</small>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold">{{ $m['pembimbing']['nama_pembimbing'] ?? '-' }}</span>
                                    <small class="text-muted">{{ $m['pembimbing']['email'] ?? '-' }}</small>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                @if(isset($m['tgl_mulai']) && $m['tgl_mulai'])
                                    <span class="badge bg-info">{{ date('d/m/Y', strtotime($m['tgl_mulai'])) }}</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @if(isset($m['tgl_selesai']) && $m['tgl_selesai'])
                                    <span class="badge bg-warning">{{ date('d/m/Y', strtotime($m['tgl_selesai'])) }}</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @if(isset($m['status_magang']))
                                    @if(strtolower($m['status_magang']) == 'mbkm')
                                        <span class="badge bg-primary px-3 py-1">MBKM</span>
                                    @elseif(strtolower($m['status_magang']) == 'mandiri')
                                        <span class="badge bg-success px-3 py-1">Mandiri</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-1">{{ ucfirst($m['status_magang']) }}</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary px-3 py-1">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.magang.edit', $m['id_magang']) }}" 
                                       class="btn btn-sm btn-outline-primary px-3"
                                       data-bs-toggle="tooltip" 
                                       title="Edit Data">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.magang.destroy', $m['id_magang']) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data magang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger px-3"
                                                data-bs-toggle="tooltip" 
                                                title="Hapus Data">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-folder-open text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h4 class="text-muted mb-2">Belum Ada Data Magang</h4>
                <p class="text-muted mb-4">Silakan tambah data magang terlebih dahulu</p>
                <a href="{{ route('admin.magang.create') }}" 
                   class="btn btn-lg px-4 py-2 fw-semibold"
                   style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                    <i class="fas fa-plus me-2"></i>Tambah Magang Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.table-row-hover:hover {
    background-color: #f8f9fc !important;
    transform: scale(1.01);
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.1);
}
.btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}
.card {
    transition: all 0.3s ease;
    border-radius: 15px !important;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1) !important;
}
.fas {
    transition: all 0.3s ease;
}
.badge {
    font-size: 0.75rem;
}
code {
    font-size: 0.8rem;
}
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
    .table td {
        padding: 0.5rem 0.25rem !important;
    }
}
* {
    transition: all 0.3s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
</script>
@endsection
