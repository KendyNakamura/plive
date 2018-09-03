<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Artist;
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
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $crawler->filter($request->selector)->each(function ($li) use ($request) {
            $date = preg_replace("/\//", ".", $li->filter($request->date_selector)->text());
            echo $d = preg_replace("/(\s+|\n|\r|\r\n|開催|\(.+\))/", "", $date);

            echo '<br/>';

            $title = preg_replace("/ |　/", "", $li->filter($request->title_selector)->text());
            echo $t = preg_replace("/.+\..+\(.+\)/", "", $title);

            echo '<br/>';
            echo '<br/>';
        });

        return view(('admin.crawler.preview'),
            [
                'name' => $name,
                'url' => $url,
            ]
        );
    }

    public function artistStore(Request $request)
    {
        Artist::create($request->all());

        return redirect(route('admin::crawler.index'))->with('result', __('c.saved'));
    }
}
