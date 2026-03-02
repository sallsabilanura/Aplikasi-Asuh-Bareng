<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KakakAsuh extends Model
{
    use HasFactory;

    protected $table = 'kakak_asuhs';
    protected $primaryKey = 'KakakAsuhID';

    protected $fillable = [
        'user_id',
        'NamaLengkap',
        'NomorHP',
        'Email',
        'Alamat',
        'StatusAktif',
        'Foto',
    ];

    /**
     * Get the assignments for this caretaker.
     */
    public function penugasan()
    {
        return $this->hasMany(PenugasanAsuh::class , 'KakakAsuhID', 'KakakAsuhID');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function kebiasaanBaik()
    {
        return $this->hasMany(KebiasaanBaik::class , 'KakakAsuhID', 'KakakAsuhID');
    }

    public function raporAsuh()
    {
        return $this->hasMany(RaporAsuh::class , 'KakakAsuhID', 'KakakAsuhID');
    }

    public function rencanaPrograms()
    {
        return $this->hasMany(RencanaProgram::class , 'KakakAsuhID', 'KakakAsuhID');
    }
}
