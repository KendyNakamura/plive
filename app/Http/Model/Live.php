<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    protected $fillable = [
        'title',
        'date',
        'artist_id',
    ];

    public function artist()
    {
    	return $this->belongsTo('App\Http\Model\Artist');
    }

}
