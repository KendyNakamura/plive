<?php

use App\Http\Model\Message;
use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');

        for($i = 1; $i <=30; $i++) {
            Message::create([
                'text' => $faker->name,
                'to_user_id' => $i,
                'to_artist_id' => null,
                'user_id' => $i,
            ]);

            Message::create([
                'text' => $faker->name,
                'to_user_id' => null,
                'to_artist_id' => $i,
                'user_id' => $i,
            ]);
        }
    }
}
