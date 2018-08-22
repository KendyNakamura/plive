<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Http\Model\Artist;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArtistRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $artist = factory(Artist::class)->create();

//        ログインしていない場合、登録ボタンがない
        $this->browse(function (Browser $browser) use ($artist) {
            $browser->visit('/artist/' . $artist->id)
                    ->assertDontSee('登録する');
        });

        $user = factory(User::class)->create();

//        ログイン後、登録ボタンが現れる。登録後に登録済に変わる
        $this->browse(function ($browser) use ($user, $artist) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/profile')
                ->visit('/artist/' . $artist->id)
                ->press('登録する')
                ->visit('/profile')
                ->assertSee('$artist->name')
                ->visit('/artist/' . $artist->id)
                ->press('登録済')
                ->visit('/profile')
                ->assertDontSee('$artist->name');
        });
    }
}
