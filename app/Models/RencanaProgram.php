<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'KakakAsuhID',
        'NamaProgram',
        'Deskripsi',
        'TargetSelesai',
        'Status',
        'KomentarAdmin',
    ];

    /**
     * Get the caretaker that owns the program.
     */
    public function kakakasuh()
    {
        return $this->belongsTo(KakakAsuh::class , 'KakakAsuhID', 'KakakAsuhID');
    }

    /**
     * Get the logbooks for the program.
     */
    public function logbooks()
    {
        return $this->hasMany(LogbookRelawan::class , 'RencanaProgramID', 'id');
    }
}
