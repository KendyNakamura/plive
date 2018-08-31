<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Artist;
use App\Http\Model\Live;
use Goutte\Client;

class CrawlerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        return view('admin.crawler.index');
    }

    public function preview(Request $request)
    {
        $name = $request->name;
        $url = $request->url;
//        $selector = $request->selector;
//        $title_selector = $request->title_selector;
//        $date_selector = $request->date_selector;
        $client = new Client();
        $lives = [];
        $crawler = $client->request('GET', $url);
        $crawler->filter($request->selector)->each(function ($li) use ($request, $lives) {
            $date = $li->filter($request->title_selector)->text();
            $title = preg_replace("/(\s+|\n|\r|\r\n|開催)/", "", $li->filter($request->date_selector)->text());
            $lives[$title] = $date;
            var_dump($lives);
        });

        return view(('admin.crawler.preview'),
            [
            'name' => $name,
            'url' => $url,
            'lives' => $lives
            ]
        );
    }

    public function artistStore(Request $request)
    {
        Artist::create($request->all());

        return redirect(route('admin::crawler.index'))->with('result', __('c.saved'));
    }
}
