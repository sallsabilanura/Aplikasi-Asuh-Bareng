<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanAsuh extends Model
{
    use HasFactory;

    protected $table = 'penugasan_asuhs';
    protected $primaryKey = 'PenugasanID';

    protected $fillable = [
        'AnakAsuhID',
        'KakakAsuhID',
        'TanggalMulai',
        'TanggalSelesai',
    ];

    /**
     * Get the child assigned.
     */
    public function anakAsuh()
    {
        return $this->belongsTo(AnakAsuh::class , 'AnakAsuhID', 'id');
    }

    /**
     * Get the caretaker assigned.
     */
    public function kakakAsuh()
    {
        return $this->belongsTo(KakakAsuh::class , 'KakakAsuhID', 'KakakAsuhID');
    }
}
