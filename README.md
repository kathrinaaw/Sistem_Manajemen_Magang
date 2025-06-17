# 📟 Sistem Manajemen Magang - Laravel

Aplikasi manajemen magang berbasis web yang memisahkan hak akses berdasarkan role **Admin** dan **Mahasiswa**. Sistem ini terhubung dengan backend API eksternal (CodeIgniter) untuk pengambilan dan pengelolaan data.

Apa itu Laravel?
Laravel adalah framework PHP yang digunakan untuk membangun aplikasi web dengan struktur yang rapi, aman, dan efisien. Laravel menerapkan prinsip MVC (Model-View-Controller) untuk memisahkan logika, tampilan, dan data, sehingga memudahkan pengembangan dan pemeliharaan aplikasi.

---

## 💠 Teknologi yang Digunakan

* **Laravel 12 (Laravel Framework 12.14.1)**
* **PHP 8.3**
* **MySQL**
* UI menggunakan html, css, dan bootstrap
* **Laravel HTTP Client** untuk komunikasi ke backend eksternal (API)

---

## 📦 Instalasi Laravel dari Awal

### 1. Pastikan Software Terinstal:

* PHP 8.3+ (`php -v`)
* Composer (`composer -V`)
* MySQL/MariaDB

### 2. Buat Project Laravel Baru

```bash
laravel new sistem-magang
# atau jika pakai composer biasa:
composer create-project laravel/laravel sistem-magang
```

### 3. Masuk ke Folder Project

```bash
cd sistem-magang
```

---

## ⚙️ Konfigurasi Aplikasi

### 4. Buat File `.env`

```bash
cp .env.example .env
```

### 5. Atur Koneksi Database di `.env`

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_manajemen_magang
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Generate App Key

```bash
php artisan key:generate
```

---

## 📂 Struktur Folder

```
app/
├── Http/
│   └── Controllers/
│       └── Admin/
│       └── Mahasiswa/
resources/
├── views/
│   └── admin/
│   └── mahasiswa/
routes/
└── web.php
```

## 🌐 Komunikasi ke Backend API (CodeIgniter)

### Contoh Controller Laravel:
php artisan make:controller NamaController

MahasiswaController.php
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class MahasiswaController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/mahasiswa');
        $mahasiswa = Mahasiswa::all();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'npm_mhs' => 'required|string|size:9|unique:mahasiswa,npm_mhs',
        'nama_mhs' => 'required|string|max:20',
        'prodi' => 'nullable|string|max:50',
        'alamat' => 'nullable|string|max:50',
        'no_telp' => 'nullable|string|size:13',
        'email' => 'nullable|email|max:30',
    ]);

    $response = Http::post('http://localhost:8080/mahasiswa', $request->all());

    if ($response->successful()) {
        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Berhasil menambahkan data.');
    } else {
        return back()->withErrors($response->json()['errors'])->withInput();
    }
}

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

        public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'npm_mhs' => 'required|string|size:9|unique:mahasiswa,npm_mhs,' . $mahasiswa->npm_mhs . ',npm_mhs',
            'nama_mhs' => 'required|string|max:20',
            'prodi' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:50',
            'no_telp' => 'nullable|string|size:13',
            'email' => 'nullable|email|max:30',
        ]);

        $response = Http::put("http://localhost:8080/mahasiswa/update/{$mahasiswa->npm_mhs}", $request->all());

        if ($response->successful()) {
            // Opsional: update local DB jika perlu
            $mahasiswa->update($request->all());

            return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil mengubah data.');
        } else {
            return back()->withErrors($response->json()['errors'] ?? ['error' => 'Gagal mengupdate data'])->withInput();
        }
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $response = Http::delete("http://localhost:8080/mahasiswa/delete/{$mahasiswa->npm_mhs}");

        if ($response->successful()) {
            // Opsional: hapus lokal jika perlu
            $mahasiswa->delete();

            return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil menghapus data.');
        } else {
            return back()->with('error', 'Gagal menghapus data.');
        }
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }
}
```

```php
use Illuminate\Support\Facades\Http;

$response = Http::get('http://localhost:8080/magang');
```

```php
class DashboardController extends Controller
{
    private $apiBaseUrl = 'http://localhost:8080';
```

### URL API dari Backend:

AuthController
```php
private $apiBaseUrl = 'http://localhost:8080/';
```

* ADMIN

DashboardController
```php
private $apiBaseUrl = 'http://localhost:8080';
```

MahasiswaController
```php
protected $apiUrl = 'http://localhost:8080/mahasiswa';
```

PembimbingController
```php
protected $apiUrl = 'http://localhost:8080/pembimbing';
```

PerusahaanController
```php
protected $apiUrl = 'http://localhost:8080/perusahaan';
```

MagangController
```php
protected $apiUrl = 'http://localhost:8080/magang';
    protected $mahasiswaApiUrl = 'http://localhost:8080/mahasiswa';
    protected $perusahaanApiUrl = 'http://localhost:8080/perusahaan';
    protected $pembimbingApiUrl = 'http://localhost:8080/pembimbing';
```

* MAHASISWA

DashboardController
```php
private $apiBaseUrl = 'http://localhost:8080';
```

PembimbingController
```php
$response = Http::get('http://localhost:8080/pembimbing');
```

PerusahaanController
```php
$response = Http::get('http://localhost:8080/perusahaan');
```

MagangController
```php
protected $apiUrl = 'http://localhost:8080/magang';
    protected $mahasiswaApiUrl = 'http://localhost:8080/mahasiswa';
    protected $perusahaanApiUrl = 'http://localhost:8080/perusahaan';
    protected $pembimbingApiUrl = 'http://localhost:8080/pembimbing';
```
---
View Mahasiswa
index.blade.php
```php
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Mahasiswa</h2>
        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    @if(count($mahasiswa) > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $mhs)
                <tr>
                    <td>{{ $mhs->npm_mhs }}</td>
                    <td>{{ $mhs->nama_mhs }}</td>
                    <td>{{ $mhs->prodi }}</td>
                    <td>{{ $mhs->alamat }}</td>
                    <td>{{ $mhs->no_telp }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.mahasiswa.edit', $mhs->npm_mhs) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.mahasiswa.destroy', $mhs->npm_mhs) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus {{ $mhs->nama_mhs }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info">
        Belum ada data mahasiswa. Silakan tambah terlebih dahulu.
    </div>
    @endif

    <!-- Summary -->
    <div class="mt-4">
        <p><strong>Total Mahasiswa:</strong> {{ count($mahasiswa) }}</p>
        <p><strong>Jumlah Prodi:</strong> {{ collect($mahasiswa)->unique('prodi')->count() }}</p>
    </div>
</div>
@endsection
```
create.blade.php
```php
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Mahasiswa</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="npm_mhs" class="form-label">NPM</label>
            <input type="text" name="npm_mhs" id="npm_mhs"
                   class="form-control" maxlength="9"
                   value="{{ old('npm_mhs') }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_mhs" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_mhs" id="nama_mhs"
                   class="form-control" maxlength="20"
                   value="{{ old('nama_mhs') }}" required>
        </div>

        <div class="mb-3">
            <label for="prodi" class="form-label">Program Studi</label>
            <input type="text" name="prodi" id="prodi"
                   class="form-control" maxlength="50"
                   value="{{ old('prodi') }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" id="alamat"
                   class="form-control" maxlength="50"
                   value="{{ old('alamat') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No. Telepon</label>
            <input type="text" name="no_telp" id="no_telp"
                   class="form-control" maxlength="13"
                   value="{{ old('no_telp') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                   class="form-control" maxlength="30"
                   value="{{ old('email') }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
```
edit.blade.php
```php
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Data Mahasiswa</h3>
    <p class="text-muted mb-4">Silakan perbarui data mahasiswa di bawah ini.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mahasiswa.update', $mahasiswa->npm_mhs) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="npm_mhs" class="form-label">NPM</label>
            <input type="text" name="npm_mhs" id="npm_mhs" class="form-control"
                   value="{{ old('npm_mhs', $mahasiswa->npm_mhs) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="nama_mhs" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_mhs" id="nama_mhs" class="form-control"
                   value="{{ old('nama_mhs', $mahasiswa->nama_mhs) }}" required>
        </div>

        <div class="mb-3">
            <label for="prodi" class="form-label">Program Studi</label>
            <input type="text" name="prodi" id="prodi" class="form-control"
                   value="{{ old('prodi', $mahasiswa->prodi) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="{{ old('email', $mahasiswa->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control"
                   value="{{ old('alamat', $mahasiswa->alamat) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No. Telepon</label>
            <input type="text" name="no_telp" id="no_telp" class="form-control"
                   value="{{ old('no_telp', $mahasiswa->no_telp) }}" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update Data</button>
        </div>
    </form>
</div>
@endsection
```
view/layouts/main.blade.php
```php
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Dashboard')</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 220px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 0;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .content {
            flex: 1;
            padding: 30px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Menu</h2>
        <a href="/">Dashboard</a>
        <a href="/mahasiswa">Data Mahasiswa</a>
        <a href="/sidang">Data Pembimbing</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
```
view/dashboard.blade.php
```php
@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <h1>Selamat datang di Dashboard!</h1>
    <p>Silakan pilih menu di sidebar.</p>
@endsection
```
---

## ▶️ Menjalankan Aplikasi

```bash
php artisan serve
```

Akses di browser: [http://localhost:8000](http://localhost:8000)

---

