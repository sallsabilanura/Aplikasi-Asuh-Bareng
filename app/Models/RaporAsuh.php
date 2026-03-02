<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaporAsuh extends Model
{
    use HasFactory;

    protected $fillable = [
        'AnakAsuhID',
        'KakakAsuhID',
        'Tahun',
        'Semester',
        'RingkasanPerkembangan',
    ];

    public function anakAsuh()
    {
        return $this->belongsTo(AnakAsuh::class , 'AnakAsuhID');
    }

    public function kakakAsuh()
    {
        return $this->belongsTo(KakakAsuh::class , 'KakakAsuhID', 'KakakAsuhID');
    }
}
