<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Artist extends Model
{
    public static function search(Request $request)
    {
        $query = Artist::query();

        if ($request->artist_search) {
            $query->where('name', 'like', "%{$request->artist_search}%");
        }

        return $query->paginate(10);
    }
}
