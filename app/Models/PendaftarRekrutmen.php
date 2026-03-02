<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarRekrutmen extends Model
{
    use HasFactory;

    protected $primaryKey = 'PendaftarID';
    protected $guarded = [];

    public function posisi()
    {
        return $this->belongsTo(PosisiRekrutmen::class , 'PosisiID', 'PosisiID');
    }
}
