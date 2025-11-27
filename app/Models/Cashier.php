<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $fillable = [
        'nama',
        'username',
        'password',
        'status',
    ];
}
