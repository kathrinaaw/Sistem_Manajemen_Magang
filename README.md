# 📟 Sistem Manajemen Magang - Laravel

Aplikasi manajemen magang berbasis web yang memisahkan hak akses berdasarkan role **Admin** dan **Mahasiswa**. Sistem ini terhubung dengan backend API eksternal (misalnya CodeIgniter 4) untuk pengambilan dan pengelolaan data.

---

## 💠 Teknologi yang Digunakan

* **Laravel 10.x**
* **PHP 8.x**
* **MySQL**
* **Bootstrap 5 (opsional)** untuk UI
* **Laravel HTTP Client** untuk komunikasi ke backend eksternal (API)
* **CodeIgniter 4 API** sebagai backend (opsional)

---

## 📦 Instalasi Laravel dari Awal

### 1. Pastikan Software Terinstal:

* PHP 8.1+ (`php -v`)
* Composer (`composer -V`)
* MySQL/MariaDB
* Git (opsional)
* Laravel installer (opsional):

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
DB_DATABASE=sistem_magang
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Generate App Key

```bash
php artisan key:generate
```

---

## 🌐 Komunikasi ke Backend API (CodeIgniter 4)

### Contoh Controller Laravel:

```php
use Illuminate\Support\Facades\Http;

$response = Http::get('http://localhost:8080/magang');
$data = $response->json();
```

### Contoh URL API:

```php
protected $apiUrl = 'http://localhost:8080/magang';
```

---

## 📂 Struktur Folder Penting

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

---

## ▶️ Menjalankan Aplikasi

```bash
php artisan serve
```

Akses di browser: [http://localhost:8000](http://localhost:8000)

---
