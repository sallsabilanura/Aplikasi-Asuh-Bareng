<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebiasaanBaik extends Model
{
    use HasFactory;

    protected $primaryKey = 'KebiasaanID';

    protected $fillable = [
        'AnakAsuhID',
        'KakakAsuhID',
        'Bulan',
        'Tahun',
        'SholatSubuh',
        'SholatZuhur',
        'SholatAshar',
        'SholatMagrib',
        'SholatIsya',
        'Mengaji',
        'BerangkatSekolah',
        'BantuOrangTua',
    ];

    public function anakAsuh()
    {
        return $this->belongsTo(AnakAsuh::class , 'AnakAsuhID', 'id');
    }

    public function kakakAsuh()
    {
        return $this->belongsTo(KakakAsuh::class , 'KakakAsuhID', 'KakakAsuhID');
    }
}
