<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $primaryKey = 'Kode_alat';
    public $incrementing = false;
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'Kode_alat',
        'kejadian',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(UserApp::class, 'user_id', 'UniqueID');
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'id_alat', 'Kode_alat');
    }
}
