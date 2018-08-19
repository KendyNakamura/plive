<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Artist;

class IndexController extends Controller
{
    public function index(Request $request)
    {
    	$artists = Artist::search($request);
    	return view('artist.index', ['artists' => $artists]);
    }

    public function show(Artist $artist)
    {
        return view('artist.show', ['artist' => $artist]);
    }
}
