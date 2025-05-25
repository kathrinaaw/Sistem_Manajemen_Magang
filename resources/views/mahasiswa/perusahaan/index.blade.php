@extends('layouts.mahasiswa')

@section('title', 'Data Perusahaan')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Perusahaan Mitra</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Perusahaan</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Stats Card -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Perusahaan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPerusahaan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Perusahaan Mitra</h6>
        </div>
        <div class="card-body">
            @if(count($perusahaanList) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Sisa Kuota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perusahaanList as $index => $perusahaan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $perusahaan['nama_perusahaan'] }}</strong></td>
                                    <td>{{ $perusahaan['alamat'] }}</td>
                                    <td>{{ $perusahaan['no_telp'] }}</td>
                                    <td>{{ $perusahaan['email_perusahaan'] }}</td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $perusahaan['jumlah_magang'] ?? 0 }} Mahasiswa
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('mahasiswa.perusahaan.show', $perusahaan['id_perusahaan']) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-building fa-3x text-gray-300"></i>
                    </div>
                    <h5 class="text-gray-600">Belum Ada Data Perusahaan</h5>
                    <p class="text-gray-500">Data perusahaan mitra belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[ 1, "asc" ]],
            "pageLength": 10
        });
    });
</script>
@endpush
@endsection
