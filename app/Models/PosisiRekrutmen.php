<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiRekrutmen extends Model
{
    use HasFactory;

    protected $primaryKey = 'PosisiID';
    protected $guarded = [];

    public function pendaftars()
    {
        return $this->hasMany(PendaftarRekrutmen::class , 'PosisiID', 'PosisiID');
    }
}
