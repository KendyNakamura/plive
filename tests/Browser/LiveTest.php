<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Http\Model\Artist;
use App\Http\Model\Live;
use App\Http\Model\Place;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LiveTest extends DuskTestCase
{
//    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLiveIndex()
    {
        $artist = factory(Artist::class)->create();

        $place1 = Place::create([
            'name' => 'Zepp Tokyo',
            'url' => 'https://hall.zepp.co.jp/tokyo/',
            'prefecture' => '東京都',
            'capacity' => 1500,
        ]);

        $live = Live::create([
            'title' => 'ライブタイトル',
            'date' => '2018.12.01',
            'artist_id' => $artist->id,
            'place_id' => 1,
            'is_active' => 1,
        ]);

        // アーティスト詳細ページに行って、アーティストの名前とライブのタイトルが表示
        $this->browse(function (Browser $browser) use ($artist, $live) {
            $browser->maximize()
                ->visit('/')
                ->clickLink($artist->name)
                ->assertPathIs('/artist/'. $artist->id)
                ->assertSee($artist->name);
            $browser->script("window.scrollTo(0, 200);");
            $browser->assertSee($live->title);
        });
    }
}
