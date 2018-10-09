<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('addtimestamp', function ($expression) {
            $path = public_path($expression);

            try {
                $timestamp = \File::lastModified($path);
            } catch (\Exception $e) {
                $timestamp = Carbon::now()->timestamp;
                report($e);
            }

            return asset($expression) . '?v=' . $timestamp;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
