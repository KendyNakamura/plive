<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Artist;
use Goutte\Client;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('register');
    }

    public function index(Request $request)
    {
    	$artists = Artist::search($request);
    	return view('artist.index', ['artists' => $artists]);
    }

    public function show(Artist $artist)
    {
        $client = new Client();
        $crawler = $client->request('GET', $artist->url);
        $dates = $crawler->filter($artist->content)->each(function($element){
            return $element->text();
        });
        return view('artist.show', ['artist' => $artist, 'dates' => $dates]);
    }

    public function register(Request $request, Artist $artist)
    {
        $artist->users()->attach($request->users);

        return redirect(route('artist.show', $artist));
    }

    public function registerDelete(Request $request, Artist $artist)
    {
        $artist->users()->find($request->users)->delete();

        return redirect(route('artist.show', $artist));
    }
}
