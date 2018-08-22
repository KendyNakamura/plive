<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Http\Model\Artist;
use App\Http\Model\Live;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LiveTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLiveIndex()
    {
        $artist = factory(Artist::class)->create();
        $live = Live::create([
            'title' => 'ライブタイトル',
            'artist_id' => $artist->id,
        ]);

        // アーティスト詳細ページに行って、アーティストの名前とライブのタイトルが表示
        $this->browse(function (Browser $browser) use ($artist, $live) {
            $browser->visit('/')
                ->clickLink($artist->name)
                ->assertPathIs('/artist/'. $artist->id)
                ->assertSee($artist->name)
                ->assertSee($live->title);
        });
    }
}
