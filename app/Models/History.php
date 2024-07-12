<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_alat',
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat', 'Kode_alat');
    }

    public function lokasis()
    {
        return $this->belongsToMany(Lokasi::class, 'history_lokasi', 'history_id', 'lokasi_id');
    }
}
