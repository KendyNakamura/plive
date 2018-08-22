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
        for ($i=1; $i < 10; $i++)
        {
            $user = factory(App\User::class)->create();

            for ($j=1; $j < 10; $j++){
                $user->artists()->attach($j);
            }
        }
    }
}
