<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'url',
        'selector',
        'title_selector',
        'date_selector',
    ];

	public function lives()
    {
    	return $this->hasMany('App\Http\Model\live');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public static function search(Request $request)
    {
        $query = Artist::query();

        if ($request->artist_search) {
            $query->where('name', 'like', "%{$request->artist_search}%");
        }

        return $query->paginate(30);
    }
}
