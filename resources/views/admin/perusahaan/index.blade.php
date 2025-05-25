@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" 
           class="btn btn-outline-secondary px-4 py-2 fw-semibold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
        </a>
    </div>

    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle me-3" 
                     style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-building text-white"></i>
                </div>
                <div>
                    <h1 class="fw-bold text-dark mb-1">Data Perusahaan</h1>
                    <p class="text-muted mb-0">Kelola informasi perusahaan tempat magang</p>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.perusahaan.create') }}" 
               class="btn btn-lg px-4 py-2 fw-semibold shadow-sm"
               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                <i class="fas fa-plus me-2"></i>Tambah Perusahaan
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-left: 4px solid #28a745 !important;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle text-success me-3"></i>
                <div>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <!-- Data Table Card -->
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-semibold text-dark mb-0">
                    <i class="fas fa-table me-2" style="color: #667eea;"></i>
                    Daftar Perusahaan
                </h5>
                <span class="badge rounded-pill px-3 py-2" 
                      style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    {{ count($perusahaan) }} Data
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            @if(count($perusahaan) > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <tr>
                            <th class="text-white fw-semibold py-3 px-4">
                                <i class="fas fa-building me-2"></i>Nama
                            </th>
                            <th class="text-white fw-semibold py-3 px-4">
                                <i class="fas fa-phone me-2"></i>Telepon
                            </th>
                            <th class="text-white fw-semibold py-3 px-4">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat
                            </th>
                            <th class="text-white fw-semibold py-3 px-4">
                                <i class="fas fa-envelope me-2"></i>Email
                            </th>
                            <th class="text-white fw-semibold py-3 px-4 text-center">
                                <i class="fas fa-cogs me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perusahaan as $item)
                        <tr class="table-row-hover">
                            <td class="py-3 px-4">
                                <span class="fw-semibold text-primary">{{ $item['nama_perusahaan'] }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-success fw-semibold">{{ $item['no_telp'] }}</span>
                            </td>
                            <td class="py-3 px-4 text-muted">{{ $item['alamat'] }}</td>
                            <td class="py-3 px-4">
                                <a href="mailto:{{ $item['email_perusahaan'] }}" class="text-decoration-none" style="color: #667eea;">
                                    {{ $item['email_perusahaan'] }}
                                </a>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.perusahaan.edit', $item['id_perusahaan']) }}" 
                                       class="btn btn-sm btn-outline-primary px-3"
                                       data-bs-toggle="tooltip" 
                                       title="Edit Data">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.perusahaan.destroy', $item['id_perusahaan']) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger px-3"
                                                data-bs-toggle="tooltip" 
                                                title="Hapus Data">
                                            Hapus
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
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-building text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h4 class="text-muted mb-2">Belum Ada Data Perusahaan</h4>
                <p class="text-muted mb-4">Silakan tambah data perusahaan terlebih dahulu</p>
                <a href="{{ route('admin.perusahaan.create') }}" 
                   class="btn btn-lg px-4 py-2 fw-semibold"
                   style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                    <i class="fas fa-plus me-2"></i>Tambah Perusahaan Pertama
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Stats Footer -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="fas fa-building fa-2x" style="color: #667eea;"></i>
                    </div>
                    <h5 class="fw-bold">{{ count($perusahaan) }}</h5>
                    <p class="text-muted mb-0">Total Perusahaan</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">  
                    <div class="text-success mb-2">
                        <i class="fas fa-handshake fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">{{ count($perusahaan) }}</h5>
                    <p class="text-muted mb-0">Mitra Kerja</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">100%</h5>
                    <p class="text-muted mb-0">Data Aktif</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Table Hover Effects */
.table-row-hover:hover {
    background-color: #f8f9fc !important;
    transform: scale(1.01);
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.1);
}

/* Button Hover Effects */
.btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

/* Card Animations */
.card {
    transition: all 0.3s ease;
    border-radius: 15px !important;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1) !important;
}

/* Custom Badge */
.badge {
    font-weight: 500 !important;
}

/* Icon Animations */
.fas {
    transition: all 0.3s ease;
}

/* Responsive Table */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
}

/* Smooth Animations */
* {
    transition: all 0.3s ease;
}

/* Purple Gradient Class */
.gradient-purple {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Custom Alert */
.alert {
    border-radius: 10px !important;
}

/* Back Button Styling */
.btn-outline-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
}
</style>

<!-- Initialize Tooltips -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips if available
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
</script>
@endsection