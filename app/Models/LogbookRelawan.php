<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookRelawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'RencanaProgramID',
        'TanggalAktivitas',
        'NamaAktivitas',
        'DeskripsiHasil',
        'FileBukti',
        'StatusValidasi',
        'KomentarAdmin',
    ];

    /**
     * Get the program that owns the logbook.
     */
    public function rencanaProgram()
    {
        return $this->belongsTo(RencanaProgram::class , 'RencanaProgramID', 'id');
    }
}
