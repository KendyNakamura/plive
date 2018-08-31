<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Artist;

class CrawlerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        if ($request->url) {
            $client = new Client();
            $crawler = $client->request('GET', $request->url);
            $crawler->filter($request->selector)->each(function ($li) use ($request) {
                $live = new Live;
                $live->title = $li->filter($request->title_selector)->text();
                $live->date = preg_replace("/(\s+|\n|\r|\r\n|開催)/", "", $li->filter($request->date_selector)->text());
                return $live;
            });
        }
        return view('admin.crawler.index');
    }

    public function artistStore(Request $request)
    {
        Artist::create($request->all());

        return redirect(route('admin::crawler.index'))->with('result', __('c.saved'));
    }
}
