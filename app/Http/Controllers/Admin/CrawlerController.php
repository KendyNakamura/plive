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
