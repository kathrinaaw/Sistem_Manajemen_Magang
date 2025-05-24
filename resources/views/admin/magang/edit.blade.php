@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle me-3" 
                     style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-briefcase text-white"></i>
                </div>
                <div>
                    <h1 class="fw-bold text-dark mb-1">Edit Magang</h1>
                    <p class="text-muted mb-0">Perbarui data magang mahasiswa</p>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.magang.index') }}" class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-left: 4px solid #dc3545 !important;">
            <div class="d-flex align-items-start">
                <i class="fas fa-exclamation-triangle text-danger me-3 mt-1"></i>
                <div>
                    <strong>Terjadi Kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-0 py-4">
            <h5 class="fw-semibold text-dark mb-0">
                <i class="fas fa-edit me-2" style="color: #667eea;"></i>
                Form Edit Data Magang
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.magang.update', $magang->id_magang) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Mahasiswa -->
                    <div class="col-md-6 mb-4">
                        <label for="npm_mhs" class="form-label fw-semibold text-dark">
                            <i class="fas fa-user-graduate me-2" style="color: #667eea;"></i>Mahasiswa
                        </label>
                        <select name="npm_mhs" class="form-select form-select-lg border-2" style="border-radius: 10px;" required>
                            @foreach($mahasiswa as $mhs)
                                <option value="{{ $mhs->npm_mhs }}" {{ $magang->npm_mhs == $mhs->npm_mhs ? 'selected' : '' }}>
                                    {{ $mhs->nama_mhs }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Perusahaan -->
                    <div class="col-md-6 mb-4">
                        <label for="id_perusahaan" class="form-label fw-semibold text-dark">
                            <i class="fas fa-building me-2" style="color: #667eea;"></i>Perusahaan
                        </label>
                        <select name="id_perusahaan" class="form-select form-select-lg border-2" style="border-radius: 10px;" required>
                            @foreach($perusahaan as $p)
                                <option value="{{ $p->id_perusahaan }}" {{ $magang->id_perusahaan == $p->id_perusahaan ? 'selected' : '' }}>
                                    {{ $p->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Pembimbing -->
                    <div class="col-md-6 mb-4">
                        <label for="nidn_pembimbing" class="form-label fw-semibold text-dark">
                            <i class="fas fa-chalkboard-teacher me-2" style="color: #667eea;"></i>Pembimbing
                        </label>
                        <select name="nidn_pembimbing" class="form-select form-select-lg border-2" style="border-radius: 10px;" required>
                            @foreach($pembimbing as $pb)
                                <option value="{{ $pb->nidn_pembimbing }}" {{ $magang->nidn_pembimbing == $pb->nidn_pembimbing ? 'selected' : '' }}>
                                    {{ $pb->nama_pembimbing }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-4">
                        <label for="status_magang" class="form-label fw-semibold text-dark">
                            <i class="fas fa-info-circle me-2" style="color: #667eea;"></i>Status Magang
                        </label>
                        <select name="status_magang" class="form-select form-select-lg border-2" style="border-radius: 10px;" required>
                            <option value="Mandiri" {{ $magang->status_magang == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                            <option value="MBKM" {{ $magang->status_magang == 'MBKM' ? 'selected' : '' }}>MBKM</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Tanggal Mulai -->
                    <div class="col-md-6 mb-4">
                        <label for="tgl_mulai" class="form-label fw-semibold text-dark">
                            <i class="fas fa-calendar-alt me-2" style="color: #667eea;"></i>Tanggal Mulai
                        </label>
                        <input type="date" name="tgl_mulai" class="form-control form-control-lg border-2" 
                               value="{{ $magang->tgl_mulai }}" required style="border-radius: 10px;">
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="col-md-6 mb-4">
                        <label for="tgl_selesai" class="form-label fw-semibold text-dark">
                            <i class="fas fa-calendar-check me-2" style="color: #667eea;"></i>Tanggal Selesai
                        </label>
                        <input type="date" name="tgl_selesai" class="form-control form-control-lg border-2" 
                               value="{{ $magang->tgl_selesai }}" required style="border-radius: 10px;">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 2px solid #f8f9fa;">
                    <a href="{{ route('admin.magang.index') }}" class="btn btn-lg btn-outline-secondary px-4 py-2">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-lg px-5 py-2 fw-semibold shadow-sm"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                        <i class="fas fa-save me-2"></i>Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
    transform: translateY(-2px);
    transition: all 0.3s ease;
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

.form-label {
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.form-control:hover {
    border-color: #667eea;
    transition: all 0.3s ease;
}

.alert {
    border-radius: 10px !important;
}

@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }

    .card-body {
        padding: 1.5rem;
    }

    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
}

* {
    transition: all 0.3s ease;
}
</style>
@endsection