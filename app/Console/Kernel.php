<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Goutte\Client;
use App\Http\Model\Artist;
use App\Http\Model\Live;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $client = new Client();
            $artists = Artist::all();
            foreach ($artists as $artist) {
                $crawler = $client->request('GET', $artist->url);
                $crawler->filter($artist->selector)->each(function ($element) use ($artist) {
                    $live = new Live;
                    $live->title = $element->text();
                    $live->artist_id = $artist->id;
                    $live->save();
                });
            }
        })->dailyAt('3:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
