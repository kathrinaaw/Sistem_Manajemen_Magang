@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle me-3" 
                     style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-chalkboard-teacher text-white"></i>
                </div>
                <div>
                    <h1 class="fw-bold text-dark mb-1">Data Pembimbing</h1>
                    <p class="text-muted mb-0">Kelola data dosen pembimbing dengan mudah</p>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.pembimbing.create') }}" 
               class="btn btn-lg px-4 py-2 fw-semibold shadow-sm"
               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                <i class="fas fa-plus me-2"></i>Tambah Pembimbing
            </a>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-semibold text-dark mb-0">
                    <i class="fas fa-table me-2" style="color: #667eea;"></i>
                    Daftar Pembimbing
                </h5>
                <span class="badge rounded-pill px-3 py-2" 
                      style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    {{ count($pembimbing) }} Data
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            @if(count($pembimbing) > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <tr>
                            <th class="text-white fw-semibold py-3 px-4">NIDN</th>
                            <th class="text-white fw-semibold py-3 px-4">Nama</th>
                            <th class="text-white fw-semibold py-3 px-4">Email</th>
                            <th class="text-white fw-semibold py-3 px-4">No. Telp</th>
                            <th class="text-white fw-semibold py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembimbing as $item)
                        <tr class="table-row-hover">
                            <td class="py-3 px-4">{{ $item->nidn_pembimbing }}</td>
                            <td class="py-3 px-4 fw-semibold">{{ $item->nama_pembimbing }}</td>
                            <td class="py-3 px-4">
                                <a href="mailto:{{ $item->email_pembimbing }}" class="text-decoration-none" style="color: #667eea;">
                                    {{ $item->email_pembimbing }}
                                </a>
                            </td>
                            <td class="py-3 px-4">{{ $item->no_telp }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.pembimbing.edit', $item->nidn_pembimbing) }}" 
                                       class="btn btn-sm btn-outline-primary px-3"
                                       data-bs-toggle="tooltip" 
                                       title="Edit Data">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.pembimbing.destroy', $item->nidn_pembimbing) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data {{ $item->nama_pembimbing }}?')">
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
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-user-times text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h4 class="text-muted mb-2">Belum Ada Data Pembimbing</h4>
                <p class="text-muted mb-4">Silakan tambah data pembimbing terlebih dahulu</p>
                <a href="{{ route('admin.pembimbing.create') }}" 
                   class="btn btn-lg px-4 py-2 fw-semibold"
                   style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                    <i class="fas fa-plus me-2"></i>Tambah Pembimbing Pertama
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
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
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