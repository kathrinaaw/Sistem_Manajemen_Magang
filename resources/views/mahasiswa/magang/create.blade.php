@extends('layouts.mahasiswa')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                     style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-briefcase text-white fs-4"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Tambah Data Magang</h2>
                <p class="text-muted">Lengkapi data magang mahasiswa dengan benar</p>
            </div>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4">
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
                    <form action="{{ route('mahasiswa.magang.store') }}" method="POST">
                        @csrf

                        <!-- ID Magang -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-key me-2" style="color: #667eea;"></i>ID Magang
                            </label>
                            <input type="text" name="id_magang" value="{{ old('id_magang') }}"
                                class="form-control form-control-lg border-0 shadow-sm"
                                style="background-color: #f8f9fc;" required>
                        </div>

                        <!-- Mahasiswa -->
                        <div class="mb-4">
    <label class="form-label fw-semibold text-dark">
        <i class="fas fa-user-graduate me-2" style="color: #667eea;"></i>Mahasiswa
    </label>
    <input 
        type="text" 
        name="npm_mhs" 
        class="form-control form-control-lg shadow-sm" 
        style="background-color: #f8f9fc;" 
        placeholder="Masukkan NPM Mahasiswa" 
        value="{{ old('npm_mhs') }}" 
        required
    >
</div>


                        <!-- Perusahaan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-building me-2" style="color: #667eea;"></i>Perusahaan
                            </label>
                            <select name="id_perusahaan" class="form-select form-select-lg shadow-sm" style="background-color: #f8f9fc;" required>
                                <option value="">Pilih Perusahaan</option>
                                @foreach($perusahaan as $p)
                                    <option value="{{ $p['id_perusahaan'] ?? '' }}" {{ old('id_perusahaan') == ($p['id_perusahaan'] ?? '') ? 'selected' : '' }}>
                                        {{ $p['nama_perusahaan'] ?? 'Nama tidak tersedia' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pembimbing -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-chalkboard-teacher me-2" style="color: #667eea;"></i>Pembimbing
                            </label>
                            <select name="nidn_pembimbing" class="form-select form-select-lg shadow-sm" style="background-color: #f8f9fc;" required>
                                <option value="">Pilih Pembimbing</option>
                                @foreach($pembimbing as $pb)
                                    <option value="{{ $pb['nidn_pembimbing'] ?? '' }}" {{ old('nidn_pembimbing') == ($pb['nidn_pembimbing'] ?? '') ? 'selected' : '' }}>
                                        {{ $pb['nama_pembimbing'] ?? 'Nama tidak tersedia' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Mulai dan Selesai -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="fas fa-calendar-alt me-2" style="color: #667eea;"></i>Tanggal Mulai
                                </label>
                                <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai') }}"
                                    class="form-control form-control-lg border-0 shadow-sm"
                                    style="background-color: #f8f9fc;" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="fas fa-calendar-check me-2" style="color: #667eea;"></i>Tanggal Selesai
                                </label>
                                <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai') }}"
                                    class="form-control form-control-lg border-0 shadow-sm"
                                    style="background-color: #f8f9fc;" required>
                            </div>
                        </div>

                        <!-- Status Magang -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-info-circle me-2" style="color: #667eea;"></i>Status Magang
                            </label>
                            <select name="status_magang" class="form-select form-select-lg shadow-sm" style="background-color: #f8f9fc;" required>
                                <option value="">Pilih Status</option>
                                <option value="mandiri" {{ old('status_magang') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                <option value="mbkm" {{ old('status_magang') == 'MBKM' ? 'selected' : '' }}>MBKM</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center pt-3">
                            <button type="submit" class="btn btn-lg px-4 py-2 fw-semibold shadow-sm me-md-3"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                            <a href="{{ route('mahasiswa.magang.index') }}"
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