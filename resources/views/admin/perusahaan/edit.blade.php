@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle me-3"
                     style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-building text-white"></i>
                </div>
                <div>
                    <h1 class="fw-bold text-dark mb-1">Edit Perusahaan</h1>
                    <p class="text-muted mb-0">Perbarui data perusahaan</p>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.perusahaan.index') }}"
               class="btn btn-outline-secondary px-4 py-2">
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
                Form Edit Data Perusahaan
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.perusahaan.update', $perusahaan->id_perusahaan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Nama Perusahaan -->
                    <div class="col-md-6 mb-4">
                        <label for="nama_perusahaan" class="form-label fw-semibold text-dark">
                            <i class="fas fa-building me-2" style="color: #667eea;"></i>Nama Perusahaan
                        </label>
                        <input type="text"
                               class="form-control form-control-lg border-2 @error('nama_perusahaan') is-invalid @enderror"
                               id="nama_perusahaan"
                               name="nama_perusahaan"
                               value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}"
                               placeholder="Masukkan nama perusahaan"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('nama_perusahaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Perusahaan -->
                    <div class="col-md-6 mb-4">
                        <label for="email_perusahaan" class="form-label fw-semibold text-dark">
                            <i class="fas fa-envelope me-2" style="color: #667eea;"></i>Email
                        </label>
                        <input type="email"
                               class="form-control form-control-lg border-2 @error('email_perusahaan') is-invalid @enderror"
                               id="email_perusahaan"
                               name="email_perusahaan"
                               value="{{ old('email_perusahaan', $perusahaan->email_perusahaan) }}"
                               placeholder="Masukkan email perusahaan"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('email_perusahaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- No Telepon -->
                    <div class="col-md-6 mb-4">
                        <label for="no_telp" class="form-label fw-semibold text-dark">
                            <i class="fas fa-phone me-2" style="color: #667eea;"></i>No. Telepon
                        </label>
                        <input type="text"
                               class="form-control form-control-lg border-2 @error('no_telp') is-invalid @enderror"
                               id="no_telp"
                               name="no_telp"
                               value="{{ old('no_telp', $perusahaan->no_telp) }}"
                               placeholder="Masukkan no. telepon"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="col-md-6 mb-4">
                        <label for="alamat" class="form-label fw-semibold text-dark">
                            <i class="fas fa-map-marker-alt me-2" style="color: #667eea;"></i>Alamat
                        </label>
                        <input type="text"
                               class="form-control form-control-lg border-2 @error('alamat') is-invalid @enderror"
                               id="alamat"
                               name="alamat"
                               value="{{ old('alamat', $perusahaan->alamat) }}"
                               placeholder="Masukkan alamat"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 2px solid #f8f9fa;">
                    <a href="{{ route('admin.perusahaan.index') }}"
                       class="btn btn-lg btn-outline-secondary px-4 py-2">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit"
                            class="btn btn-lg px-5 py-2 fw-semibold shadow-sm"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                        <i class="fas fa-save me-2"></i>Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Card -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle text-primary me-3"></i>
                        <div>
                            <strong>Tips:</strong> Pastikan semua data yang dimasukkan sudah benar sebelum menyimpan perubahan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
