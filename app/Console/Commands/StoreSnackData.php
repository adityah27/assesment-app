<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Providers\SnackServiceProvider;
use Illuminate\Support\Facades\File;
class StoreSnackData extends Command
{
    protected $signature = 'fetch:snack-data';
    protected $description = 'Fetch and store snack data from the API';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch snack data using the API wrapper
        $snackApi = new SnackServiceProvider();
        $snackData = $snackApi->index(1);

        // Store the data locally 
        $filePath = storage_path('app/snack-data.json');
        File::put($filePath, json_encode($snackData));

        $this->info('Snack data fetched and stored successfully.');
    }
}
