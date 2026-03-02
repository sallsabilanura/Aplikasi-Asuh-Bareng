<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiPendampingan extends Model
{
    use HasFactory;

    protected $table = 'absensi_pendampingans';
    protected $primaryKey = 'AbsensiID';

    protected $fillable = [
        'AnakAsuhID',
        'KakakAsuhID',
        'JenisPendampingan',
        'Tanggal',
        'WaktuMulai',
        'WaktuSelesai',
        'DeskripsiPerkembangan',
        'NilaiPendampingan',
        'NilaiHuruf',
        'Kendala',
        'FotoBukti',
        'StatusValidasi',
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
