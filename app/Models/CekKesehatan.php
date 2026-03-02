<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekKesehatan extends Model
{
    use HasFactory;

    protected $table = 'cek_kesehatans';
    protected $primaryKey = 'KesehatanID';

    protected $fillable = [
        'AnakAsuhID',
        'TanggalPemeriksaan',
        'BeratBadan',
        'TinggiBadan',
        'LingkarKepala',
        'IMT',
        'StatusGizi',
        'KesehatanMata',
        'KesehatanGigi',
        'Pendengaran',
        'RiwayatPenyakit',
        'MotorikKasar',
        'MotorikHalus',
        'ResponsSensorik',
        'InteraksiSosial',
        'FokusKonsentrasi',
        'EkspresiEmosi',
        'FrekuensiMakan',
        'JenisMakanan',
        'PolaTidur',
        'WaktuTidur',
        'WaktuBangun',
        'KebiasaanTidur',
        'CatatanPemeriksaan',
        'TandaTanganPemeriksa',
        'Foto',
    ];

    public function anakAsuh()
    {
        return $this->belongsTo(AnakAsuh::class , 'AnakAsuhID');
    }
}
