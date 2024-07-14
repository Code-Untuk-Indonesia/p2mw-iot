<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserApp extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'user_apps';

    protected $primaryKey = 'UniqueID';

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'kode_alat'
    ];

    public function alat()
    {
        return $this->hasOne(Alat::class, 'userapps_id', 'UniqueID');
    }

    public function getKeyName()
    {
        return 'UniqueID';
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
