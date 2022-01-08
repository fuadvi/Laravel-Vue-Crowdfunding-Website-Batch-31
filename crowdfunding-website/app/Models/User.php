<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Traits\UsesUuid;

class User extends Model
{
    use UsesUuid;

    protected $fillable = ["username", "password", "email", "nama", "role_id"];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function otpCode()
    {
        return $this->hasOne('App\Models\Otp_code');
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
