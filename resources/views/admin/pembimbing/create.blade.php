@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                     style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-chalkboard-teacher text-white fs-4"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Tambah Pembimbing</h2>
                <p class="text-muted">Lengkapi data pembimbing dengan benar</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-left: 4px solid #dc3545 !important;">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-exclamation-triangle text-danger me-3 mt-1"></i>
                        <div>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <form action="{{ route('admin.pembimbing.store') }}" method="POST">
                        @csrf

                        <!-- NIDN -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-id-card me-2" style="color: #667eea;"></i>NIDN
                            </label>
                            <input type="text" 
                                   name="nidn_pembimbing" 
                                   class="form-control form-control-lg border-0 shadow-sm @error('nidn_pembimbing') is-invalid @enderror" 
                                   style="background-color: #f8f9fc;"
                                   value="{{ old('nidn_pembimbing') }}" 
                                   placeholder="Masukkan NIDN"
                                   required>
                            @error('nidn_pembimbing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-user me-2" style="color: #667eea;"></i>Nama Lengkap
                            </label>
                            <input type="text" 
                                   name="nama_pembimbing" 
                                   class="form-control form-control-lg border-0 shadow-sm @error('nama_pembimbing') is-invalid @enderror" 
                                   style="background-color: #f8f9fc;"
                                   value="{{ old('nama_pembimbing') }}" 
                                   placeholder="Masukkan nama lengkap"
                                   required>
                            @error('nama_pembimbing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email - PERBAIKAN: Ubah name dari email_pembimbing ke email -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-envelope me-2" style="color: #667eea;"></i>Email
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control form-control-lg border-0 shadow-sm @error('email') is-invalid @enderror" 
                                   style="background-color: #f8f9fc;"
                                   value="{{ old('email') }}" 
                                   placeholder="contoh@email.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-phone me-2" style="color: #667eea;"></i>Nomor Telepon
                            </label>
                            <input type="text" 
                                   name="no_telp" 
                                   class="form-control form-control-lg border-0 shadow-sm @error('no_telp') is-invalid @enderror" 
                                   style="background-color: #f8f9fc;"
                                   value="{{ old('no_telp') }}" 
                                   placeholder="Contoh: 08123456789"
                                   required>
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center pt-3">
                            <button type="submit" 
                                    class="btn btn-lg px-4 py-2 fw-semibold shadow-sm me-md-3"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                            <a href="{{ route('admin.pembimbing.index') }}" 
                               class="btn btn-outline-secondary btn-lg px-4 py-2 fw-semibold">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Pastikan semua data yang dimasukkan sudah benar
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan style jika belum ada -->
<style>
.form-control:focus {
    background-color: #ffffff !important;
    border: 2px solid #667eea !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15) !important;
    transform: translateY(-1px);
    transition: all 0.3s ease;
}

.form-control:hover {
    background-color: #ffffff !important;
    transform: translateY(-1px);
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
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.1) !important;
}

* {
    transition: all 0.3s ease;
}

.gradient-purple {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.fas {
    transition: all 0.3s ease;
}

.form-label:hover .fas {
    transform: scale(1.1);
}
</style>
@endsection