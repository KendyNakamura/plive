<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    public function artist()
    {
    	return $this->belongsTo('App\Http\Model\Artist');
    }
}
