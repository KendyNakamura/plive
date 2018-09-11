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
    public function testRegister()
    {
        $artist = factory(Artist::class)->create();

//        ログインしていない場合、登録ボタンがない
        $this->browse(function (Browser $browser) use ($artist) {
            $browser->visit('/artist/' . $artist->id)
                    ->assertDontSee('登録する');
        });

        $user = factory(User::class)->create();

//        ログイン後、登録ボタンが現れる。登録後に登録解除に変わる
        $this->browse(function ($browser) use ($user, $artist) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/')
                ->visit('/artist/' . $artist->id)
                ->click('#artistRegister')
                ->waitForText(__('c.register_release'))
                ->visit('/profile')
                ->assertSee($user->artists->where('id', $user->id)->first()->name)
                ->visit('/artist/' . $artist->id)
                ->click('#artistDelete')
                ->waitForText(__('c.register'))
                ->visit('/profile')
                ->assertDontSee($user->artists->where('id', $user->id)->first()->name);
        });
    }
}
