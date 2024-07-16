<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'alat_id',
        'lat',
        'long'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
}
