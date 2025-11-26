<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $fillable = [
        'id_kasir',
        'nama',
        'username',
        'password',
        'status'
    ];
}


