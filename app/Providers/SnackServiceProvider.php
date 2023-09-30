<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Pagination\LengthAwarePaginator;
class SnackServiceProvider extends ServiceProvider
{
    protected $baseUrl;
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://snackmaster.wiremockapi.cloud',
            'timeout' => 10, // Adjust the timeout as needed
            'headers' => [
                'Authorization' => 'Bearer ' . 'lj5iaSIZAhOFCk8dXfWrnjsUsAqKiePoblbh',
            ],
            'verify' => false, // Disable SSL certificate verification (use with caution)
        ]);
    
    }

    /**
     * Get a list of snacks from the API.
     *
     * @return array|null
     */
    
    public function index($check=null)
    {
       
        // Make a GET request to retrieve snacks
        $response = $this->client->get('/snacks'); // Specify the URI here
    
        // Check if the response is successful (status code 200)
        if ($response->getStatusCode() === 200) {
            // Parse the JSON response into an array
            $snacks = json_decode($response->getBody(), true);

            if($check!=null){
                return $snacks;
             }
             else {
            // Use the $snacks data as needed
            // Convert the array to a collection
                    $snacksCollection = collect($snacks);

                    // Get the current page from the request's query parameter (default to 1)
                    $currentPage = request()->query('page', 1);

                    // Define the number of items per page
                    $perPage = 6;

                    // Slice the collection to get items for the current page
                    $currentPageItems = $snacksCollection->forPage($currentPage, $perPage);

                    // Create a LengthAwarePaginator instance for pagination
                    $paginator = new LengthAwarePaginator(
                        $currentPageItems,
                        $snacksCollection->count(),
                        $perPage,
                        $currentPage,
                        ['/' => route('index')] // Adjust this route name as needed
                    );
                    
                    return view('Snacklist', compact('paginator', 'snacks'));
                   
                    } 
            } 
            else {
           
            // You can return an error view, log the error, or take other actions
            
            $errorMessage = 'An error occurred. Please try again later.'; // Replace with an appropriate error message.

            // Pass the error message to the view for display.
            return view('errorPage')->with('errorMessage', $errorMessage);
        }
    }
}
