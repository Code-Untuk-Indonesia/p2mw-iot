<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'alat_id',
        'long',
        'lat'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'Lokasi_id');
    }

    public function realtimes()
    {
        return $this->hasMany(Realtime::class, 'lokasi_id');
    }
}
