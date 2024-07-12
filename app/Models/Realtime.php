<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'Lokasi_id',
        'lat',
        'lon',
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'Lokasi_id', 'Lokasi_id');
    }
}
