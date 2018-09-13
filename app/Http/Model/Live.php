<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Goutte\Client;

class Live extends Model
{
    protected $fillable = [
        'title',
        'date',
        'artist_id',
    ];

    public function artist()
    {
    	return $this->belongsTo('App\Http\Model\Artist');
    }

    public static function crawlerSave($request, $artist)
    {
        $url = $request->url;
        $client = new Client();
        $crawler = $client->request('GET', $url);

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
    }

    public static function crawlerPreview($request)
    {
        $client = new Client();
        $crawler = $client->request('GET', $request->url);

        $crawler->filter($request->selector)->each(function ($li) use ($request) {
            if ($request->date_selector && count($li->filter($request->date_selector))) {
                $date = preg_replace("/\//", ".", $li->filter($request->date_selector)->text());
                echo $d = preg_replace("/(\s+|\n|\r|\r\n|開催|\(.+\))/", "", $date). '<br/>';
            } else {
                echo 'dateセレクタが有効ではありません<br/>';
            }

            if($request->title_selector && count($li->filter($request->title_selector))){
                $title = preg_replace("/ |　/", "", $li->filter($request->title_selector)->text());
                echo $t = preg_replace("/.+\..+\(.+\)/", "", $title). '<br/>';
            } else {
                echo 'titleセレクタが有効ではありません<br/>';
            }
            echo '<br/>';
        });

        return $crawler;
    }

}
