@extends('layouts.mahasiswa')

@section('title', 'Detail Pembimbing - ' . $pembimbing->nama_pembimbing)

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembimbing</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.pembimbing.index') }}">Pembimbing</a></li>
                <li class="breadcrumb-item active">{{ $pembimbing->nama_pembimbing }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <!-- Pembimbing Info -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user-tie"></i> Profil Pembimbing
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 100px; height: 100px;">
                                <i class="fas fa-user-tie fa-3x text-white"></i>
                            </div>
                            <h5 class="font-weight-bold text-gray-800">{{ $pembimbing->nama_pembimbing }}</h5>
                            <p class="text-muted">NIDN: {{ $pembimbing->nidn_pembimbing }}</p>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong><i class="fas fa-id-card text-primary"></i> NIDN</strong></td>
                                    <td>: {{ $pembimbing->nidn_pembimbing }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-user text-primary"></i> Nama Lengkap</strong></td>
                                    <td>: {{ $pembimbing->nama_pembimbing }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-envelope text-primary"></i> Email</strong></td>
                                    <td>: <a href="mailto:{{ $pembimbing->email }}">{{ $pembimbing->email }}</a></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-phone text-primary"></i> No. Telepon</strong></td>
                                    <td>: <a href="tel:{{ $pembimbing->no_telp }}">{{ $pembimbing->no_telp }}</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <a href="{{ route('mahasiswa.pembimbing.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('mahasiswa.magang.create') }}?pembimbing={{ $pembimbing->nidn_pembimbing }}" 
                           class="btn btn-primary">
                            <i class="fas fa-plus"></i> Pilih Sebagai Pembimbing
                        </a>
                    </div>
                </div>
            </div>

            <!-- Perusahaan Kerjasama -->
            @if($perusahaanKerjasama->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Perusahaan Kerjasama</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($perusahaanKerjasama as $perusahaan)
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-building text-primary mr-2"></i>
                                    <a href="{{ route('mahasiswa.perusahaan.show', $perusahaan->id_perusahaan) }}" 
                                       class="text-decoration-none">
                                        {{ $perusahaan->nama_perusahaan }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Statistics -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Bimbingan</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Bimbingan:</span>
                            <span class="h5 font-weight-bold text-primary">{{ $stats['total_bimbingan'] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Bimbingan Aktif:</span>
                            <span class="badge badge-success badge-lg">{{ $stats['bimbingan_aktif'] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Bimbingan Selesai:</span>
                            <span class="badge badge-info badge-lg">{{ $stats['bimbingan_selesai'] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Bimbingan Pending:</span>
                            <span class="badge badge-warning badge-lg">{{ $stats['bimbingan_pending'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Contact -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kontak Cepat</h6>
                </div>
                <div class="card-body">
                    <a href="mailto:{{ $pembimbing->email }}" class="btn btn-outline-primary btn-block mb-2">
                        <i class="fas fa-envelope"></i> Kirim Email
                    </a>
                    <a href="tel:{{ $pembimbing->no_telp }}" class="btn btn-outline-success btn-block">
                        <i class="fas fa-phone"></i> Telepon
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Bimbingan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Bimbingan</h6>
        </div>
        <div class="card-body">
            @if($daftarBimbingan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Perusahaan</th>
                                <th>Periode Magang</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarBimbingan as $index => $bimbingan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $bimbingan->nama_mhs }}</strong>
                                    </td>
                                    <td>
                                        <a href="{{ route('mahasiswa.perusahaan.show', $bimbingan->id_perusahaan) }}" 
                                           class="text-decoration-none">
                                            {{ $bimbingan->nama_perusahaan }}
                                        </a>
                                    </td>
                                    <td>
                                        <small>
                                            {{ \Carbon\Carbon::parse($bimbingan->tgl_mulai)->format('d M Y') }} - 
                                            {{ \Carbon\Carbon::parse($bimbingan->tgl_selesai)->format('d M Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        @if($bimbingan->status_magang == 'aktif')
                                            <span class="badge badge-success">Aktif</span>
                                        @elseif($bimbingan->status_magang == 'selesai')
                                            <span class="badge badge-info">Selesai</span>
                                        @elseif($bimbingan->status_magang == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $bimbingan->status_magang }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" 
                                                title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-clipboard-list fa-3x text-gray-300"></i>
                    </div>
                    <h5 class="text-gray-600">Belum Ada Riwayat Bimbingan</h5>
                    <p class="text-gray-500">Pembimbing ini belum membimbing mahasiswa manapun.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .badge-lg {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
    }
</style>
@endpush
@endsection