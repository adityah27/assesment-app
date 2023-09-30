<?php

namespace App\Http\Controllers;
use App\Providers\SnackServiceProvider;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\SnacksModel;
class Snacks extends Controller
{
        public function index(){
           
            //initiating wrapper api
            $snackApiService = new SnackServiceProvider();
             // Use the SnackApiService to fetch snacks from the external API
                return $snackApiService->index();
       // return view('Snacklist', compact('paginator', 'snacks'));
        }

}
