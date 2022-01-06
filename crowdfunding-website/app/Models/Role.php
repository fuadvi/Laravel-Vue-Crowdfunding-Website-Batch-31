<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $fillable = ['nama'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->{$model->getKeyName()}) {
                $model->{$model->getKeyName()} = Str::uuid();
            }
        });
    }
}
