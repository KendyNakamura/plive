<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Model\Artist;
use App\Http\Controllers\Controller;
use Goutte\Client;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['register', 'registerDelete']);
    }

    public function index(Request $request)
    {
    	$artists = Artist::search($request);
    	return view('web.artist.index', ['artists' => $artists]);
    }

    public function show(Artist $artist)
    {
        $client = new Client();
        $crawler = $client->request('GET', $artist->url);
        $dates = $crawler->filter($artist->date_selector)->each(function($element){
            return $element->text();
        });
        return view('web.artist.show', ['artist' => $artist, 'dates' => $dates]);
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