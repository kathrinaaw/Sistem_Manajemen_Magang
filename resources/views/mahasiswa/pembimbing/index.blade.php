@extends('layouts.mahasiswa')

@section('title', 'Data Pembimbing')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pembimbing Magang</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pembimbing</li>
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

    <!-- Data Cards Grid -->
    <div class="row">
        @forelse($pembimbingList as $pembimbing)
            <div class="col-lg-6 col-xl-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3 d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-user-tie text-white"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="m-0 font-weight-bold text-primary">
                                {{ $pembimbing['nama_pembimbing'] }}
                            </h6>
                            <small class="text-muted">NIDN: {{ $pembimbing['nidn_pembimbing'] }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <strong><i class="fas fa-envelope text-gray-400"></i> Email:</strong><br>
                            <span class="text-muted">{{ $pembimbing['email'] }}</span>
                        </div>
                        <div class="mb-3">
                            <strong><i class="fas fa-phone text-gray-400"></i> No. Telepon:</strong><br>
                            <span class="text-muted">{{ $pembimbing['no_telp'] }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('mahasiswa.pembimbing.show', $pembimbing['nidn_pembimbing']) }}" 
                           class="btn btn-info btn-sm btn-block">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-user-tie fa-3x text-gray-300"></i>
                        </div>
                        <h5 class="text-gray-600">Belum Ada Data Pembimbing</h5>
                        <p class="text-gray-500">Data pembimbing belum tersedia dalam sistem.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Tabel Data Pembimbing -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pembimbing</h6>
        </div>
        <div class="card-body">
            @if(count($pembimbingList) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIDN</th>
                                <th>Nama Pembimbing</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembimbingList as $index => $pembimbing)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pembimbing['nidn_pembimbing'] }}</td>
                                    <td><strong>{{ $pembimbing['nama_pembimbing'] }}</strong></td>
                                    <td>{{ $pembimbing['email'] }}</td>
                                    <td>{{ $pembimbing['no_telp'] }}</td>
                                    <td>
                                        <a href="{{ route('mahasiswa.pembimbing.show', $pembimbing['nidn_pembimbing']) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .icon-circle {
        height: 2.5rem;
        width: 2.5rem;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[ 2, "asc" ]],
            "pageLength": 10
        });
    });
</script>
@endpush
@endsection
