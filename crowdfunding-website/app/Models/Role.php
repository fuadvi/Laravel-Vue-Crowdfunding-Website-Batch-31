<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use UsesUuid;
    protected $fillable = ['nama'];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
