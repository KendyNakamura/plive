<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistIndexRequest;
use App\Http\Model\Artist;
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
//        for($i = 0; $i <= 2; $i++){
//            $monthes[] = Carbon::now()->addMonth($i)->format('Y/m');
//            $end_days = Carbon::now()->addMonthNoOverflow($i)->endOfMonth()->format('d');
//            for($j = 0;$j <= $end_days-1; $j++) {
//                $days[$monthes[$i]][$j] = Carbon::now()->addMonthNoOverflow($i)->startOfMonth()->addDay($j)->format('d');
//            }
//        }
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
