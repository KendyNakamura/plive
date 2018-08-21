<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Artist;
use Goutte\Client;

class IndexController extends Controller
{
    public function index(Request $request)
    {
    	$artists = Artist::search($request);
    	return view('artist.index', ['artists' => $artists]);
    }

    public function show(Artist $artist)
    {
        $client = new Client();
        $crawler = $client->request('GET', $artist->url);
        $lives = $crawler->filter($artist->content)->each(function($element){
            return $element->text()."\n";
        });
        return view('artist.show', ['artist' => $artist, 'lives' => $lives]);
    }
}
