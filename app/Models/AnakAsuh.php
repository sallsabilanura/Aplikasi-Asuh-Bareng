<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnakAsuh extends Model
{
    use HasFactory;

    protected $table = 'anak_asuhs';
    // Migration changed to $table->id()
    protected $primaryKey = 'id';

    protected $fillable = [
        'NamaLengkap',
        'NamaOrangTua',
        'NomorTelp',
        'TempatLahir',
        'TanggalLahir',
        'JenisKelamin',
        'Alamat',
        'Sekolah',
        'Kelas',
        'Status',
        'FotoAnak',
    ];

    /**
     * Get age automatically from TanggalLahir.
     *
     * @return int
     */
    public function getUmurAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['TanggalLahir'])->age;
    }

    /**
     * Get the assignments for this child.
     */
    public function penugasan()
    {
        return $this->hasMany(PenugasanAsuh::class , 'AnakAsuhID', 'id');
    }

    public function cekKesehatan()
    {
        return $this->hasMany(CekKesehatan::class , 'AnakAsuhID', 'id');
    }

    public function kebiasaanBaik()
    {
        return $this->hasMany(KebiasaanBaik::class , 'AnakAsuhID', 'id');
    }

    public function raporAsuh()
    {
        return $this->hasMany(RaporAsuh::class , 'AnakAsuhID', 'id');
    }
}
