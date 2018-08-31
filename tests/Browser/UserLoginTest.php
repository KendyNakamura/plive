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
            // 登録後、ログインされてプロフィール画面へ
            $browser->visit('/register')
                ->type('name', $faker->name)
                ->type('email', $faker->unique()->safeEmail)
                ->type('password', 'secret')
                ->type('password_confirmation', 'secret')
                ->press('Register')
                ->assertPathIs('/profile');

            // ログアウト
            $browser->visit('/')
                ->clickLink('Logout')
                ->assertPathIs('/login');
        });
    }

    public function testUserLogin()
    {
        $user = factory(User::class)->create();

        // ログイン後、トップ画面へ
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/');
        });
    }
}
