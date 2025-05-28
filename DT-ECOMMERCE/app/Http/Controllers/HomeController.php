<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    

    public function index()
    {
        // $url = 'https://api.wheelpros.com/auth/v1/authorize';
        // $yearsApiEndpoint = 'https://api.wheelpros.com/vehicles/v1/years';
        // $wheelApiEndpoint = 'https://api.wheelpros.com/products/v1/search/wheel';

        // $data = [
        //     'userName' => 'kidwellauto@gmail.com',
        //     'password' => 'Liftnasium1!',
        // ];

        // Send authentication request
        // $authResponse = Http::post($url, $data);

        // Check if there's an error in the authentication
        // if ($authResponse->failed()) {
        //     return 'Authentication error: ' . $authResponse->body();
        // }

        // $accessToken = $authResponse['accessToken'];

        // Fetch data using the access token
        // $wheelResponse = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $accessToken,
        // ])->get($wheelApiEndpoint);

        // Check if there's an error in fetching data
        // if ($wheelResponse->failed()) {
        //     return 'Data fetching error: ' . $wheelResponse->body();
        // }

        // Process the fetched data
        // $wheelData = $wheelResponse->json();

        // dd($wheelData);

        // Extract the "results" array
        // $resultsArray = $wheelData['results'] ?? [];


        // Take the first 5 items from the shuffled array
        // $resultsCollection = collect(array_slice($resultsArray, 0, 12));

        $resultsCollection = [];



        return view('home',compact('resultsCollection'));
    }
}
