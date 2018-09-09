<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
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

    public function artistStore(ArtistRequest $request)
    {
        $name = $request->name;
        $url = $request->url;
        $client = new Client();
        $crawler = $client->request('GET', $url);
        // プレビュー
        if ($request->action == "preview")
        {
            if ($request->selector) {
                $crawler->filter($request->selector)->each(function ($li) use ($request) {
                    if ($li && $request->date_selector && $request->title_selector) {
                        $date = preg_replace("/\//", ".", $li->filter($request->date_selector)->text());
                        echo $d = preg_replace("/(\s+|\n|\r|\r\n|開催|\(.+\))/", "", $date);

                        echo '<br/>';

                        $title = preg_replace("/ |　/", "", $li->filter($request->title_selector)->text());
                        echo $t = preg_replace("/.+\..+\(.+\)/", "", $title);

                        echo '<br/>';
                        echo '<br/>';
                    } else {
                        echo 'セレクタが有効ではありません。';
                    }
                });

                return view(('admin.crawler.preview'),
                    [
                        'name' => $name,
                        'url' => $url,
                    ]
                );
            }
            return view('admin.crawler.index')->with('result', __('c.error'));
        }

        if(!is_null($request->file('main')))
        {
            $request->file('main')->storeAs('public/images/'. $request->name, 'main.jpg');
        }

        // アーティストとライブ保存
        $artist = Artist::create($request->all());

        $crawler->filter($request->selector)->each(function ($li) use ($request, $artist) {
            if ($li) {
                $live = new Live;
                $title = preg_replace("/ |　/", "", $li->filter($artist->title_selector)->text());
                $live->title = preg_replace("/.+\..+\(.+\)/", "", $title);
                $date = preg_replace("/\//", ".", $li->filter($artist->date_selector)->text());
                $live->date = preg_replace("/(\s+|\n|\r|\r\n|開催|\(.+\))/", "", $date);
                $live->artist_id = $artist->id;
                $live->save();
            }
        });

        return redirect(route('admin::crawler.index'))->with('result', __('c.saved'));
    }
}
