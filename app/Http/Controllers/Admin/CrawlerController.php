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

    public function artistStore(Request $request)
    {
        $name = $request->name;
        $url = $request->url;
        $client = new Client();
        $crawler = $client->request('GET', $url);

        // プレビュー
        if ($request->action == "preview")
        {
            if ($crawler) {
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
            return view('admin.crawler.index');
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

    public function imageUpload(Request $request)
    {
        //アップロードパスを指定する。(storage/images)
        $upload_file_path = 'storage/images/';

        //テキストの入力値を受け取る。
        $result = $request->has('text');
        if ($result) {
            $text = $request->input('text');
        }

        $image_name = ceil(microtime(true)*1000) . '.jpg';
        //アップロードファイルを受け取る。
        $result = $request->file('file')->isValid();
        if($result){

            //ファイルを格納する。
            $file = $request->file('file')->move($upload_file_path , $image_name);
        }

        return $text;
        //テキストの内容を付与してhtml(test.blade.php)を返却する。
//        return view('admin.crawler.index')->with("ret", $text);
    }
}
