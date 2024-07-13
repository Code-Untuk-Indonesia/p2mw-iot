<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_alat',
        'Lokasi_id'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'Lokasi_id');
    }
}
