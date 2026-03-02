<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $fillable = [
        'NamaLengkap',
        'NomorTelepon',
        'Email',
        'Alamat',
        'TipeDonatur',
        'Keterangan',
    ];
}
