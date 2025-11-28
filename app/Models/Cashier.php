<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $primaryKey = 'id_kasir'; // sesuai tabel
    protected $table = 'cashiers';
    public $timestamps = true;

    protected $fillable = [
        'nama',       // kolom di DB
        'username',
        'password',
        'status',
    ];
}

