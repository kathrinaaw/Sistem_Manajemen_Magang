<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $table = 'magang';
    protected $primaryKey = 'id_magang';
    public $timestamps = false;
    protected $guarded = [];

        public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm_mhs', 'npm_mhs');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'nidn_pembimbing', 'nidn_pembimbing');
    }
}