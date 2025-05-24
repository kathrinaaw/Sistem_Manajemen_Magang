@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                     style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-building text-white fs-4"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Tambah Perusahaan</h2>
                <p class="text-muted">Lengkapi data perusahaan dengan benar</p>
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
                    <form action="{{ route('admin.perusahaan.store') }}" method="POST">
                        @csrf

                        <!-- Nama Perusahaan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-building me-2" style="color: #667eea;"></i>Nama Perusahaan
                            </label>
                            <input type="text" 
                                   name="nama_perusahaan" 
                                   class="form-control form-control-lg border-0 shadow-sm" 
                                   style="background-color: #f8f9fc;"
                                   value="{{ old('nama_perusahaan') }}" 
                                   placeholder="Masukkan nama perusahaan"
                                   required>
                        </div>

                        <!-- Telepon -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-phone me-2" style="color: #667eea;"></i>Nomor Telepon
                            </label>
                            <input type="text" 
                                   name="no_telp" 
                                   class="form-control form-control-lg border-0 shadow-sm" 
                                   style="background-color: #f8f9fc;"
                                   value="{{ old('no_telp') }}" 
                                   placeholder="Contoh: 08123456789"
                                   required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-map-marker-alt me-2" style="color: #667eea;"></i>Alamat
                            </label>
                            <input type="text" 
                                   name="alamat" 
                                   class="form-control form-control-lg border-0 shadow-sm" 
                                   style="background-color: #f8f9fc;"
                                   value="{{ old('alamat') }}" 
                                   placeholder="Masukkan alamat lengkap"
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-envelope me-2" style="color: #667eea;"></i>Email
                            </label>
                            <input type="email" 
                                   name="email_perusahaan" 
                                   class="form-control form-control-lg border-0 shadow-sm" 
                                   style="background-color: #f8f9fc;"
                                   value="{{ old('email_perusahaan') }}" 
                                   placeholder="contoh@email.com"
                                   required>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center pt-3">
                            <button type="submit" 
                                    class="btn btn-lg px-4 py-2 fw-semibold shadow-sm me-md-3"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                            <a href="{{ route('admin.perusahaan.index') }}" 
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
@endsection
