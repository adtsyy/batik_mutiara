<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $fillable = [
        'id_kasir', // atau 'name' kalau kolom di database bernama name
        'nama',     // hapus salah satu sesuai nama kolom tabel
        'username',
        'password',
        'status',
    ];
}
