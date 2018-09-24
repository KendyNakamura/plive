<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistIndexRequest;
use App\Http\Model\Artist;
use App\Http\Model\Tag;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['register', 'registerDelete']);
    }

    public function index(ArtistIndexRequest $request)
    {
    	$artists = Artist::search($request);
    	return view('artist.index', ['artists' => $artists, 'tags' => Tag::all()]);
    }

    public function show(Artist $artist)
    {
        return view('artist.show', ['artist' => $artist]);
    }

    public function register(Request $request, Artist $artist)
    {
        $artist->users()->attach($request->register);

        return redirect(route('artist.show', $artist));
    }

    public function registerDelete(Request $request, Artist $artist)
    {
        $artist->users()->detach($request->delete);

        return redirect(route('artist.show', $artist));
    }
}
