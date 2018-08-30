<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Http\Model\Admin;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends DuskTestCase
{

    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $admin = Admin::create(['name' => 'admin', 'email' => 'test@example.com', 'password' => bcrypt('password')]);

        $this->browse(function (Browser $browser) {
            $browser->visit('admin')
                ->assertPathIs('admin/login');
        });

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->visit('admin/login')
                ->type('email', $admin->email)
                ->type('password', 'password')
                ->press('Login')
                ->assertPathIs('admin');
        });
    }
}
