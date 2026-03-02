<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyaluran extends Model
{
    use HasFactory;

    protected $fillable = [
        'AnakAsuhID',
        'Bulan',
        'Tahun',
        'Nominal',
        'Keterangan',
    ];

    public function anakAsuh()
    {
        return $this->belongsTo(AnakAsuh::class, 'AnakAsuhID');
    }
}
