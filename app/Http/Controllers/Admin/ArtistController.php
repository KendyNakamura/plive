<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use App\Http\Requests\ArtistIndexRequest;
use App\Http\Controllers\Controller;
use App\Http\Model\Artist;
use App\Http\Model\Live;
use App\Http\Model\Tag;
use Goutte\Client;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(ArtistIndexRequest $request)
    {
        $artists = Artist::search($request);
        return view('admin.artist.index', ['artists' => $artists]);
    }

    public function edit(Artist $artist)
    {
        return view('admin.artist.edit', ['artist' => $artist, 'tags' => Tag::all()]);
    }

    public function update(ArtistRequest $request, Artist $artist)
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
            return redirect(route('admin::artist.edit', $artist))->with('result', __('c.error'));
        }

        if(!is_null($request->file('main')))
        {
            $request->file('main')->storeAs('public/images/'. $request->name, 'main.jpg');
        }

        $artist->fill($request->all())->save();
        $artist->tags()->sync($request->tags);
        return redirect(route('admin::artist.edit', $artist))->with('result', __('c.updated'));
    }
}
