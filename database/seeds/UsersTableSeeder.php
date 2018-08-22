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
        factory(App\User::class, 5)->create();

        \Enomotodev\LaractiveAdmin\AdminUser::create([
        	'email' => 'kenji.nkmr.1117@gmail.com',
        	'password' => bcrypt('1qaz2wsx'),
        ]);

        for ($i=1; $i < 10; $i++)
        {
            $user = factory(App\User::class)->create();

            for ($j=1; $j < 10; $j++){
                $user->artists()->attach($j);
            }
        }
    }
}
