<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
 use GuzzleHttp\Client;
 use GuzzleHttp\Exception\RequestException;
use App\Providers\SnackServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /*
     * Register any application services.
     
    public function register(): void
    {
        //
    }
*/
    /* Bootstrap any application services.
     
    public function boot(): void
    {
        //
    }*/
    public function boot()
    {
        // Initialize SnackApiService and set up API connection
       // $snackApiService = new SnackServiceProvider();

        // Add your code to run on app start here

        // For example, you can fetch snacks from the API and store them in a cache
       // $snacks = $snackApiService->index();
       // cache(['snacks' => $snacks], 60); // Cache snacks for 60 minutes

        // You can also log information or perform any other initialization tasks here
        // For example:
        // \Log::info('Application started.');
    }
    
}
