<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    protected $table = 'pembimbing';
    protected $primaryKey = 'nidn_pembimbing';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nidn_pembimbing',
        'nama_pembimbing',
        'email', 
        'no_telp'
    ];
}