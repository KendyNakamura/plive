<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use App\Http\Requests\ArtistIndexRequest;
use App\Http\Requests\LiveRequest;
use App\Http\Controllers\Controller;
use App\Http\Model\Artist;
use App\Http\Model\Live;
use App\Http\Model\Place;
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
        return view('admin.artist.index', [
            'artists' => $artists,
        ]);
    }

    public function create()
    {
        return view('admin.artist.create', [
            'tags' => Tag::all(),
        ]);
    }

    public function store(ArtistRequest $request)
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
            return view('admin.artist.create')->with('result', __('c.error'));
        }

        if(!is_null($request->file('main')))
        {
            $request->file('main')->storeAs('public/images/'. $request->name, 'main.jpg');
        }

        // アーティストとライブ保存
        $artist = Artist::create($request->all());
        $artist->tags()->sync($request->tags);

        return redirect(route('admin::artist.create'))->with('result', __('c.saved'));
    }

    public function edit(Artist $artist)
    {
        return view('admin.artist.edit', ['artist' => $artist, 'tags' => Tag::all(), 'places' => Place::all()]);
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

        $artist->tags()->sync($request->tags);
        $artist->fill($request->all())->save();

        return redirect(route('admin::artist.edit', $artist))->with('result', __('c.updated'));
    }

    public function livesUpdate(LiveRequest $request, Artist $artist)
    {
        $lives = Live::all()->where('artist_id', $artist->id);
        foreach($lives as $live)
        {
            $live->date = $request->date[$live->id];
            $live->title = $request->title[$live->id];
            $live->place_id = $request->place_id[$live->id];
            $live->is_active = $request->is_active[$live->id] ?? 0;
            $live->save();
        }
        return redirect(route('admin::artist.edit', $artist))->with('result', __('c.saved'));
    }

    public function liveDelete(Request $request, Live $live)
    {
        $live->delete();
        return redirect(route('admin::artist.edit', $live->artist))->with('result', __('c.deleted'));
    }
}
