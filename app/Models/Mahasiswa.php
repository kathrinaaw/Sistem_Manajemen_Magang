<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm_mhs';  // Primary key di tabel adalah npm_mhs
    public $incrementing = false;       // Karena bukan auto increment integer
    protected $keyType = 'string';      // Karena tipe char(9)

    protected $fillable = [
        'npm_mhs', 'nama_mhs', 'prodi', 'alamat', 'no_telp', 'email'
    ];

    public $timestamps = false;          // Jika tabel tidak ada timestamp created_at, updated_at
}
