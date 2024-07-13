<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{
    use HasFactory;

    protected $table = 'user_apps';

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
}
