<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
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
                try {
                    $crawler = $client->request('GET', $artist->url);
                    $crawler->filter($artist->selector)->each(function ($li) use ($artist) {
                        $live = new Live;
                        if ($artist->date_selector && count($li->filter($artist->date_selector))) {
                            $date = preg_replace("/\//", ".", $li->filter($artist->date_selector)->text());
                            preg_match("/\d{8}/", preg_replace("/[^0-9]/u", "", $date), $d);
                            if($d) {
                                $live->date = $d[0];
                            } else {
                                $live->date = 2018;
                                echo $artist->name. "修正あり\n";
                            }
                        } else {
                            return "dateセレクタが有効ではありません\n";
                        }

                        if ($artist->title_selector && count($li->filter($artist->title_selector))) {
                            $title = preg_replace("/ |　/", "", $li->filter($artist->title_selector)->text());
                            $t = preg_replace("/.+\..+\(.+\)/", "", $title);
                            $live->title = $t;
                        } else {
                            return "titleセレクタが有効ではありません\n";
                        }

                        $live->artist_id = $artist->id;

                        $live->is_active = 1;

                        if (empty($artist->lives->where('date', $live->date)->first()) && empty($artist->lives->where('title', $live->title)->first())) {
                            $live->save();
                        }
                    });
                } catch(\Exception $e){
                    throw $e;
                }
            };

            $today = preg_replace('/\./', '', Carbon::today()->format('Y.m.d'));
            foreach (Live::all() as $live) {
                if(is_numeric($live->date)) {
                    if ($live->date - $today < 0) {
                        $live->is_active = 0;
                        $live->save();
                    }
                }
            }
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
