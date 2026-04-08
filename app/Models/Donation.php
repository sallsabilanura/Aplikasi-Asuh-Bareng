<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'anak_asuh_id',
        'amount',
        'status',
        'payment_type',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anakAsuh()
    {
        return $this->belongsTo(AnakAsuh::class);
    }
}
