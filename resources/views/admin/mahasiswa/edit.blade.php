@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle me-3" 
                     style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-user-edit text-white"></i>
                </div>
                <div>
                    <h1 class="fw-bold text-dark mb-1">Edit Mahasiswa</h1>
                    <p class="text-muted mb-0">Perbarui data mahasiswa</p>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.mahasiswa.index') }}" 
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
                Form Edit Data Mahasiswa
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.mahasiswa.update', $mahasiswa->npm_mhs) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- NPM Field -->
                    <div class="col-md-6 mb-4">
                        <label for="npm_mhs" class="form-label fw-semibold text-dark">
                            <i class="fas fa-id-badge me-2" style="color: #667eea;"></i>NPM
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg border-2 @error('npm_mhs') is-invalid @enderror" 
                               id="npm_mhs"
                               name="npm_mhs" 
                               value="{{ old('npm_mhs', $mahasiswa->npm_mhs) }}" 
                               maxlength="9"
                               placeholder="Masukkan NPM"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('npm_mhs')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Field -->
                    <div class="col-md-6 mb-4">
                        <label for="nama_mhs" class="form-label fw-semibold text-dark">
                            <i class="fas fa-user me-2" style="color: #667eea;"></i>Nama Lengkap
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg border-2 @error('nama_mhs') is-invalid @enderror" 
                               id="nama_mhs"
                               name="nama_mhs" 
                               value="{{ old('nama_mhs', $mahasiswa->nama_mhs) }}" 
                               maxlength="20"
                               placeholder="Masukkan nama lengkap"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('nama_mhs')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Prodi Field -->
                    <div class="col-md-6 mb-4">
                        <label for="prodi" class="form-label fw-semibold text-dark">
                            <i class="fas fa-graduation-cap me-2" style="color: #667eea;"></i>Program Studi
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg border-2 @error('prodi') is-invalid @enderror" 
                               id="prodi"
                               name="prodi" 
                               value="{{ old('prodi', $mahasiswa->prodi) }}" 
                               maxlength="50"
                               placeholder="Masukkan program studi"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="col-md-6 mb-4">
                        <label for="email" class="form-label fw-semibold text-dark">
                            <i class="fas fa-envelope me-2" style="color: #667eea;"></i>Email
                        </label>
                        <input type="email" 
                               class="form-control form-control-lg border-2 @error('email') is-invalid @enderror" 
                               id="email"
                               name="email" 
                               value="{{ old('email', $mahasiswa->email) }}" 
                               maxlength="30"
                               placeholder="Masukkan email"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Alamat Field -->
                    <div class="col-md-8 mb-4">
                        <label for="alamat" class="form-label fw-semibold text-dark">
                            <i class="fas fa-map-marker-alt me-2" style="color: #667eea;"></i>Alamat
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg border-2 @error('alamat') is-invalid @enderror" 
                               id="alamat"
                               name="alamat" 
                               value="{{ old('alamat', $mahasiswa->alamat) }}" 
                               maxlength="50"
                               placeholder="Masukkan alamat lengkap"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- No Telp Field -->
                    <div class="col-md-4 mb-4">
                        <label for="no_telp" class="form-label fw-semibold text-dark">
                            <i class="fas fa-phone me-2" style="color: #667eea;"></i>No. Telepon
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg border-2 @error('no_telp') is-invalid @enderror" 
                               id="no_telp"
                               name="no_telp" 
                               value="{{ old('no_telp', $mahasiswa->no_telp) }}" 
                               maxlength="13"
                               placeholder="Masukkan no. telepon"
                               style="border-color: #e0e6ed; border-radius: 10px;">
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 2px solid #f8f9fa;">
                    <a href="{{ route('admin.mahasiswa.index') }}" 
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

<style>
/* Form Input Focus Effects */
.form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
    transform: translateY(-2px);
    transition: all 0.3s ease;
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

/* Form Label Styling */
.form-label {
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

/* Input Hover Effects */
.form-control:hover {
    border-color: #667eea;
    transition: all 0.3s ease;
}

/* Custom Alert */
.alert {
    border-radius: 10px !important;
}

/* Responsive Design */
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

/* Smooth Animations */
* {
    transition: all 0.3s ease;
}

/* Purple Gradient Class */
.gradient-purple {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>
@endsection