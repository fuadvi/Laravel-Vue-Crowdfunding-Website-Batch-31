<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Role;

class User extends Model
{
    protected $fillable = ["username", "email", "nama", "role_id"];
    protected $primaryKey = 'id';
    protected $keyTpye = 'string';
    public $incrementing = false;

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->{$model->getKeyName()}) {
                $model->{$model->getKeyName()} = Str::uuid();
            }
        });
    }
}
