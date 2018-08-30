<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserIndexTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testUserIndex()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            // ログイン画面に戻される
            $browser->visit('/profile')
                ->assertPathIs('/login');

            // ログイン
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/profile')
            // プロフィール画面に行けること
                ->assertSee('プロフィール')
                ->assertSee($user->name);
        });
    }
}
