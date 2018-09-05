<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistIndexRequest;
use App\Http\Controllers\Controller;
use App\Http\Model\Artist;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(ArtistIndexRequest $request)
    {
//        $artists = Artist::all();
        $artists = Artist::search($request);
        return view('admin.artist.index', ['artists' => $artists]);
    }
}
