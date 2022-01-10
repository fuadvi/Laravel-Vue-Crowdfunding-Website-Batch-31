<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Traits\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, UsesUuid;

    protected $fillable = ["username", "password", "email", "nama", "role_id", 'photo'];
    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function otpCode()
    {
        return $this->hasOne('App\Models\OtpCode');
    }

    public function IsAdmin()
    {

        if ($this->role->nama == 'admin') {
            return true;
        }
        return false;
    }

    public function get_users_role()
    {
        $role = Role::where('nama', 'user')->first();

        return $role->id;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->role_id = $model->get_users_role();
        });
    }
}
