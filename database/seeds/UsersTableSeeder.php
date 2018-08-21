<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function ($u) {
            $u->artists()->save(factory(App\Http\Model\Artist::class, 5)->create()->each(function ($v) {
                $v->lives()->save(factory(App\Http\Model\Live::class, 5)->make());
            });
        });
    }
}
