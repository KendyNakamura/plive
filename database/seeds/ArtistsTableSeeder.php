<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Plive\Http\Model\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 1; $i <= 10; $i++) {
    		Artist::create([
	            'name' => str_random(10),
		        'url' => 'https://google.com',
		        'content' => 'アーティストに関する説明' . $i,
	            'image' => 'images/tama.jpg'
        	]);
        }
    }
}
