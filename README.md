# 📟 Sistem Manajemen Magang - Laravel

Aplikasi manajemen magang berbasis web yang memisahkan hak akses berdasarkan role **Admin** dan **Mahasiswa**. Sistem ini terhubung dengan backend API eksternal (CodeIgniter) untuk pengambilan dan pengelolaan data.

Apa itu Laravel?
Laravel adalah framework PHP yang digunakan untuk membangun aplikasi web dengan struktur yang rapi, aman, dan efisien. Laravel menerapkan prinsip MVC (Model-View-Controller) untuk memisahkan logika, tampilan, dan data, sehingga memudahkan pengembangan dan pemeliharaan aplikasi.

---

## 💠 Teknologi yang Digunakan

* **Laravel 12 (Laravel Framework 12.14.1)**
* **PHP 8.3**
* **MySQL**
* UI menggunakan html, css
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



---

## ▶️ Menjalankan Aplikasi

```bash
php artisan serve
```

Akses di browser: [http://localhost:8000](http://localhost:8000)

---
