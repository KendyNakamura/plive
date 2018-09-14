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
                $crawler->filter($artist->selector)->each(function ($li) use ($artist) {
                    if ($li) {
                        $live = new Live;
                        $title = preg_replace("/ |　/", "", $li->filter($artist->title_selector)->text());
                        $live->title = preg_replace("/.+\..+\(.+\)/", "", $title);
                        $date = preg_replace("/\//", ".", $li->filter($artist->date_selector)->text());
                        $date2 = preg_replace("/(\s+|\n|\r|\r\n)/", "", $date);
                        preg_match("/\d+\.\d+\.\d+/", $date2,$date3 );
                        $live->date = $date3[0] ?? "";
//                        $live->date = preg_replace("/(\s+|\n|\r|\r\n|開催|\(.+\)|\[.+\n.+)/", "", $date);
                        $live->artist_id = $artist->id;
                        if (empty($artist->lives->where('title', $live->title)->first()) && $li) {
                            $live->save();
                        }
                    }
                });
            }
        })
//        })->dailyAt('3:00')
            ->after(function () {
                echo 'finish';
            });
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
