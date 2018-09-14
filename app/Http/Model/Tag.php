<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title',
        'text',
    ];

    public function artists()
    {
        return $this->belongsToMany('App\Http\Model\Artist');
    }
}
