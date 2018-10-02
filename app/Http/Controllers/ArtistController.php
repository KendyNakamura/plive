<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistIndexRequest;
use App\Http\Model\Artist;
use App\Http\Model\Message;
use App\Http\Model\Tag;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['register', 'registerDelete']);
    }

    public function index(ArtistIndexRequest $request)
    {
        $index = 0;
    	$artists = Artist::search($request);
    	return view('artist.index', ['artists' => $artists, 'tags' => Tag::all(), 'index' => $index]);
    }

    public function show(Artist $artist)
    {
        $messages = Message::all();
        return view('artist.show', ['artist' => $artist, 'messages' => $messages]);
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
