<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Http\Model\Artist;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArtistIndexTest extends DuskTestCase
{
//    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testExample()
    {

        $artist = factory(Artist::class)->create();

        $this->browse(function (Browser $browser) use ($artist) {
            $browser->visit('/')
                ->assertSee('Plive')
                ->assertSee($artist->name)
                ->assertSee($artist->content);
        });
    }
}
