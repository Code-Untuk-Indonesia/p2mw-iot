<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'lat',
        'lon',
    ];

    public function histories()
    {
        return $this->belongsToMany(History::class, 'history_lokasi', 'lokasi_id', 'history_id');
    }

    public function realtimes()
    {
        return $this->hasMany(Realtime::class, 'Lokasi_id', 'Lokasi_id');
    }
}
