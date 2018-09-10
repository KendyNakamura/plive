<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'url',
        'selector',
        'title_selector',
        'date_selector',
    ];

	public function lives()
    {
    	return $this->hasMany('App\Http\Model\live');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    // 検索条件
    public static function search(Request $request)
    {
        $query = Artist::query();

        if ($request->artist_search) {
            $query->where('name', 'like', "%{$request->artist_search}%");
        }

        return $query->paginate(30);
    }

    // アーティスト画像のURL取得
    public function getImgUrlAttribute()
    {
        if($this->has_img)
        {
            return Storage::url('images/' . $this->name . '/main.jpg');
        }
        return asset('storage/images/no.jpeg');
    }

    // 画像が登録されているかどうか
    public function getHasImgAttribute()
    {
        return Storage::disk('public')->exists('images/' . $this->name . '/main.jpg');
    }

    // アーティストを登録しているかどうか
    public function getArtistRegisterAttribute()
    {
        return $this->users()->get()->where('id', Auth::user()->id);
    }
}
