<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
        'url',
        'prefecture',
        'capacity',
    ];

    public function lives()
    {
        return $this->hasMany('App\Http\Model\Live');
    }
}
