@extends('layouts.mahasiswa')

@section('title', 'Detail Perusahaan - ' . $perusahaan->nama_perusahaan)

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Perusahaan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.perusahaan.index') }}">Perusahaan</a></li>
                <li class="breadcrumb-item active">{{ $perusahaan->nama_perusahaan }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <!-- Company Info -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-building"></i> {{ $perusahaan->nama_perusahaan }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>ID Perusahaan</strong></td>
                                    <td>: {{ $perusahaan->id_perusahaan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Perusahaan</strong></td>
                                    <td>: {{ $perusahaan->nama_perusahaan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>: {{ $perusahaan->alamat }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>No. Telepon</strong></td>
                                    <td>: {{ $perusahaan->no_telp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>: {{ $perusahaan->email_perusahaan }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <a href="{{ route('mahasiswa.perusahaan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('mahasiswa.magang.create') }}?perusahaan={{ $perusahaan->id_perusahaan }}" 
                           class="btn btn-primary">
                            <i class="fas fa-plus"></i> Daftar Magang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Magang</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Total Magang:</span>
                            <strong>{{ $stats['total_magang'] }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Magang Aktif:</span>
                            <span class="badge badge-success">{{ $stats['magang_aktif'] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Magang Selesai:</span>
                            <span class="badge badge-info">{{ $stats['magang_selesai'] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Magang Pending:</span>
                            <span class="badge badge-warning">{{ $stats['magang_pending'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Magang -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Magang di {{ $perusahaan->nama_perusahaan }}</h6>
        </div>
        <div class="card-body">
            @if($daftarMagang->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Pembimbing</th>
                                <th>Periode Magang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarMagang as $index => $magang)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $magang->nama_mhs }}</td>
                                    <td>{{ $magang->nama_pembimbing }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($magang->tgl_mulai)->format('d M Y') }} - 
                                        {{ \Carbon\Carbon::parse($magang->tgl_selesai)->format('d M Y') }}
                                    </td>
                                    <td>
                                        @if($magang->status_magang == 'aktif')
                                            <span class="badge badge-success">Aktif</span>
                                        @elseif($magang->status_magang == 'selesai')
                                            <span class="badge badge-info">Selesai</span>
                                        @elseif($magang->status_magang == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $magang->status_magang }}</span>
                                        @endif
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
                    <h5 class="text-gray-600">Belum Ada Riwayat Magang</h5>
                    <p class="text-gray-500">Belum ada mahasiswa yang magang di perusahaan ini.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection