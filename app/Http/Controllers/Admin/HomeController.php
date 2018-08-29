<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Goutte\Client;
use App\Http\Model\Artist;
use App\Http\Model\Live;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function crowlerIndex(Request $request)
    {
        if ($request->url) {
            $client = new Client();
            $crawler = $client->request('GET', $request->url);
            $crawler->filter($request->selector)->each(function ($li) use ($request) {
                $live = new Live;
                echo $live->title = $li->filter($request->title_selector)->text();
                echo $live->date = preg_replace("/(\s+|\n|\r|\r\n|開催)/", "", $li->filter($request->date_selector)->text());
            });
        }
        return view('admin.crowler.index');
    }
}
