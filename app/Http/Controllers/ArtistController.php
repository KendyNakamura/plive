<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Artist;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['register', 'registerDelete']);
    }

    public function index(Request $request)
    {
    	$artists = Artist::search($request);
    	return view('artist.index', ['artists' => $artists]);
    }

    public function show(Artist $artist)
    {
        return view('artist.show', ['artist' => $artist]);
    }

    public function register(Request $request, Artist $artist)
    {
        $artist->users()->attach($request->users);

        return redirect(route('artist.show', $artist))->with('result', __('c.registered'));
    }

    public function registerDelete(Request $request, Artist $artist)
    {
        $artist->users()->detach($request->users);;

        return redirect(route('artist.show', $artist))->with('result', __('c.deleted'));
    }
}
