<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Http\Model\Artist;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ArtistIndexTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testArtistPage()
    {

        $artist = factory(Artist::class)->create();

        $this->browse(function (Browser $browser) use ($artist) {
//            作成したアーティストが表示されていること
            $browser->visit('/')
                ->assertSee('Plive')
                ->assertSee($artist->name)
                ->assertSee($artist->content);

//            アーティストの詳細ページ
            $browser->visit('/')
                ->clickLink($artist->name)
                ->assertPathIs('/artist/'. $artist->id)
                ->assertSee('Plive')
                ->assertSee($artist->name);
        });
    }
}
