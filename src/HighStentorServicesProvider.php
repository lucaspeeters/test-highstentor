<?php

namespace lpeeters\highstentor;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class HighStentorServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('highLang', function ($arguments) {
            list($string, $ISO_code) = explode(',',str_replace(['(',')',' ', "'"], '', $arguments));
            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                'GET',
                'https://translate.io/api/texts/' . $string . '/' . $ISO_code,
                ['verify' => false]);
            return $response->getBody();
        });
    }
}
