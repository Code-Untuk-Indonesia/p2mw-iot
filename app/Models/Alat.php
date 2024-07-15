<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'userapps_id',
        'kejadian',
        'kodealat'
    ];

    public function userApp()
    {
        return $this->belongsTo(UserApp::class, 'userapps_id', 'UniqueID');
    }

    public function lokasis()
    {
        return $this->hasMany(Lokasi::class, 'alat_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'id_alat');
    }

    public function realtimes()
    {
        return $this->hasMany(Realtime::class, 'alat_id');
    }
}
