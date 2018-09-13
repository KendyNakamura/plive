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
        // プレビュー
        if ($request->action == "preview")
        {
            if ($request->selector) {
                Live::crawlerPreview($request);
                return view(('admin.crawler.preview'),
                    [
                        'name' => $name,
                        'url' => $request->url,
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

        Live::crawlerSave($request, $artist);
        return redirect(route('admin::crawler.index'))->with('result', __('c.saved'));
    }
}
