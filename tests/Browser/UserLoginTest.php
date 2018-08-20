<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\User;
use Faker\Factory as Faker;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     * @group usertest
     */
    public function testUserRegister()
    {
        $faker = Faker::create('ja_JP');

        $this->browse(function ($browser) use ($faker) {
            // ログイン
            $browser->visit('/register')
                ->type('name', $faker->name)
                ->type('email', $faker->unique()->safeEmail)
                ->type('password', 'secret')
                ->type('password_confirmation', 'secret')
                ->press('Register')
                ->assertPathIs('/profile');

            // ログアウト
            $browser->visit('/')
                ->click('@myname')
                ->clickLink('Logout')
                ->assertPathIs('/');
        });
    }

    public function testUserLogin()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/profile');
        });
    }
}
