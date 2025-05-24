@extends('layouts.mahasiswa')

@section('title', 'Detail Pengajuan Magang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Detail Pengajuan Magang</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('mahasiswa.magang.index') }}">Magang</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-clipboard-text-outline me-1"></i>
                        Pengajuan Magang #{{ $magang->id_magang }}
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Status Badge -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-muted mb-0">Status Pengajuan:</h6>
                                @if($magang->status_magang == 'pending')
                                    <span class="badge bg-warning text-dark fs-6">
                                        <i class="mdi mdi-clock-outline me-1"></i>Menunggu Persetujuan
                                    </span>
                                @elseif($magang->status_magang == 'disetujui')
                                    <span class="badge bg-success fs-6">
                                        <i class="mdi mdi-check-circle me-1"></i>Disetujui
                                    </span>
                                @elseif($magang->status_magang == 'ditolak')
                                    <span class="badge bg-danger fs-6">
                                        <i class="mdi mdi-close-circle me-1"></i>Ditolak
                                    </span>
                                @else
                                    <span class="badge bg-secondary fs-6">{{ ucfirst($magang->status_magang) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Detail Information -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="mdi mdi-account me-1"></i>Data Mahasiswa</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td class="fw-semibold" width="40%">NPM:</td>
                                            <td>{{ $magang->mahasiswa->npm_mhs ?? $magang->npm_mhs }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Nama:</td>
                                            <td>{{ $magang->mahasiswa->nama_mhs ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Program Studi:</td>
                                            <td>{{ $magang->mahasiswa->prodi ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0"><i class="mdi mdi-office-building me-1"></i>Data Perusahaan</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td class="fw-semibold" width="40%">Nama:</td>
                                            <td>{{ $magang->perusahaan->nama_perusahaan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Alamat:</td>
                                            <td>{{ $magang->perusahaan->alamat_perusahaan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Kontak:</td>
                                            <td>{{ $magang->perusahaan->kontak_perusahaan ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0"><i class="mdi mdi-account-tie me-1"></i>Dosen Pembimbing</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td class="fw-semibold" width="40%">NIDN:</td>
                                            <td>{{ $magang->pembimbing->nidn_pembimbing ?? $magang->nidn_pembimbing }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Nama:</td>
                                            <td>{{ $magang->pembimbing->nama_pembimbing ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Email:</td>
                                            <td>{{ $magang->pembimbing->email_pembimbing ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-warning text-dark">
                                    <h6 class="mb-0"><i class="mdi mdi-calendar-range me-1"></i>Periode Magang</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td class="fw-semibold" width="40%">Tanggal Mulai:</td>
                                            <td>{{ \Carbon\Carbon::parse($magang->tgl_mulai)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Tanggal Selesai:</td>
                                            <td>{{ \Carbon\Carbon::parse($magang->tgl_selesai)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Durasi:</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($magang->tgl_mulai)->diffInDays(\Carbon\Carbon::parse($magang->tgl_selesai)) + 1 }} hari
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('mahasiswa.magang.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali
                        </a>
                        
                        @if($magang->status_magang == 'mbkm')
                            <span class="badge bg-primary fs-6">
                                <i class="mdi mdi-school me-1"></i>MBKM
                            </span>
                        @elseif($magang->status_magang == 'mandiri')
                            <span class="badge bg-info text-dark fs-6">
                                <i class="mdi mdi-briefcase me-1"></i>Mandiri
                            </span>
                        @else
                            <span class="badge bg-secondary fs-6">{{ ucfirst($magang->status_magang) }}</span>
                        @endif
                    </div>

                    <!-- Additional Info -->
                    @if($magang->catatan_admin)
                        <div class="mt-4">
                            <div class="alert alert-info">
                                <h6><i class="mdi mdi-information me-1"></i>Catatan Admin:</h6>
                                <p class="mb-0">{{ $magang->catatan_admin }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    .badge {
        padding: 8px 12px;
        border-radius: 20px;
    }
    
    .table td {
        padding: 0.5rem 0;
    }
    
    .page-title-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }
</style>
@endpush