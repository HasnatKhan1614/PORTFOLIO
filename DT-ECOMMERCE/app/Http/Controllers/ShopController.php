<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\Gallery;



class ShopController extends Controller
{
    protected $url = 'https://api.wheelpros.com/auth/v1/authorize';
    protected $yearsApiEndpoint = 'https://api.wheelpros.com/vehicles/v1/years';
    protected $wheelApiEndpoint = 'https://api.wheelpros.com/products/v1/search/wheel';

    public function authenticationToken()
    {
    
        $data = [
            'userName' => 'kidwellauto@gmail.com',
            'password' => 'Liftnasium1!',
        ];
    
        // Send authentication request
        $authResponse = Http::post($this->url, $data);
    
        // Check if there's an error in the authentication
        if ($authResponse->failed()) {
            return 'Authentication error: ' . $authResponse->body();
        }
    
        return $authResponse['accessToken'];
    }

    public function authorization()
    {
        $accessToken = $this->authenticationToken();
        // Create an empty collection to store the processed data
    
        // Get current page number
        $currentPage = request()->query('page', 1);
    
        // Fetch data using the access token and page number
        $wheelResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get($this->wheelApiEndpoint, ['page' => $currentPage]);
    
        // Check if there's an error in fetching data
        if ($wheelResponse->failed()) {
            return 'Data fetching error: ' . $wheelResponse->body();
        }

        // Process the fetched data
        $wheelData = $wheelResponse->json();

        // Extract the "results" array
        $resultsArray = $wheelData['results'] ?? [];



        return $resultsArray;
    }

    public function index()
    {
        

        // $resultsArray = $this->authorization();

        // Get current page number
        $currentPage = request()->items ?? 1;

        $recordsPerPage = request()->items ?? 12;

        $recordsPerPage = $recordsPerPage / 2;


        // Paginate the results with base URL
        // $resultsCollection = new Paginator($resultsArray, $recordsPerPage, $currentPage, ['path' => url('/shop')]);
    
        $processedCollection = collect();

        //get products from database
        $generalItems = DB::table('general')
        ->select('sku', 'title', 'price', 'image_1')
        ->inRandomOrder()
        ->take($recordsPerPage)
        ->get();
    
    
        foreach ($generalItems as $item) {
            $processedData = [
                'sku' => $item->sku ?? '',
                'title' => $item->title ?? '',
                'prices' => $item->price ?? '',
                'images' => $item->image_1 ?? '',
                'skuType' => 'Random',
                'vendorName' => 'roughcountry',
            ];
            $processedCollection->push($processedData);
        }

        // Iterate over each item in the results collection
        // foreach ($resultsCollection as $item) {
        //     // Extract the desired data
        //     $sku = $item['sku'] ?? null;
        //     $title = $item['title'] ?? null;
        //     $prices = $item['prices']['msrp'][0]['currencyAmount'] ?? null; 

        //     if(isset($item['images']) && count($item['images']) > 0){
        //         $images = $item['images'][0]['imageUrlOriginal']; 
        //     }else{
        //         $images = asset('assets/images/no-image.png');
        //     }

        //     $skuType = $item['skuType'] ?? null;

        //     // Create an array with the extracted data
        //     $processedData = [
        //         'sku' => $sku,
        //         'title' => $title,
        //         'prices' => $prices,
        //         'images' => $images,
        //         'skuType' => $skuType,
        //         'vendorName' => 'wheelpros',
        //     ];

        //     // Push the data into the processed collection
        //     $processedCollection->push($processedData);
        // }

        // Get unique years for dropdown
        $uniqueYears = DB::table('vehicle_fitment')
        ->select('startyear')
        ->groupBy('startyear')
        ->orderBy('startyear', 'desc')
        ->distinct()
        ->pluck('startyear');

        $uniqueProductByCategory = DB::table('general')
        ->select('category', DB::raw('MAX(image_1) as image_1'))
        ->groupBy('category')
        ->inRandomOrder() // Shuffle the results randomly
        ->take(13)        // Take 13 items
        ->get();
    
        // $uniqueModels = DB::table('vehicle_fitment')->select('model')->groupBy('model')->orderBy('model', 'asc')->distinct()->pluck('model');
        // $uniqueYears = DB::table('vehicle_fitment')->select('startyear')->groupBy('startyear')->orderBy('startyear', 'desc')->distinct()->pluck('startyear');

        // Shuffle the processed collection in place
        $processedCollection->shuffle();
        
        return view('shop', compact(
        // 'resultsCollection',
        'processedCollection',
        'uniqueYears',
        'recordsPerPage',
        'uniqueProductByCategory'
        ));
    }

    public function wp_product_detail($sku){

    
        $resultsArray = $this->authorization();

        $randomResultsArrayData = collect($resultsArray)->take(5);

        $randomResultsArray = collect();

        // Iterate over each item in the results collection
        foreach ($randomResultsArrayData as $item) {
            // Extract the desired data
            $sku = $item['sku'] ?? null;
            $title = $item['title'] ?? null;
            $prices = $item['prices']['msrp'][0]['currencyAmount'] ?? null; 

            if(isset($item['images']) && count($item['images']) > 0){
                $images = $item['images'][0]['imageUrlOriginal']; 
            }else{
                $images = asset('assets/images/no-image.png');
            }

            $skuType = $item['skuType'] ?? null;

            // Create an array with the extracted data
            $processedData = [
                'sku' => $sku,
                'title' => $title,
                'prices' => $prices,
                'images' => $images,
                'skuType' => $skuType,
                'vendorName' => 'wheelpros',
            ];

            // Push the data into the processed collection
            $randomResultsArray->push($processedData);
        }
    
        $resultsArrayBySkuData = collect($resultsArray)->where('sku',$sku)->first();

        // Extract the desired data
        $sku = $resultsArrayBySkuData['sku'] ?? null;
        $title = $resultsArrayBySkuData['title'] ?? null;
        $prices = $resultsArrayBySkuData['prices']['msrp'][0]['currencyAmount'] ?? null; 

        if(isset($resultsArrayBySkuData['images']) && count($resultsArrayBySkuData['images']) > 0){
            $images = $resultsArrayBySkuData['images'][0]['imageUrlOriginal']; 
        }else{
            $images = asset('assets/images/no-image.png');
        }

        $skuType = $resultsArrayBySkuData['skuType'] ?? null;
        
        // Create an array with the extracted data
        $resultsArrayBySku = [
            'sku' => $sku,
            'title' => $title,
            'prices' => $prices,
            'images' => $images,
            'skuType' => $skuType,
            'vendorName' => 'wheelpros',
        ];
        
        return view('product-detail',compact('resultsArrayBySku','randomResultsArray'));
    }
    
    public function rc_product_detail($sku)
    {
        //get products from database
        $randomResultsArrayData = DB::table('general')
        ->select('sku', 'title', 'price', 'image_1')
        ->inRandomOrder()
        ->take(6)
        ->get();

        //get products from database
        $resultsArrayBySkuData = DB::table('general')
        ->where('sku',$sku)
        ->select('sku', 'title', 'price', 'image_1')
        ->inRandomOrder()
        ->take(6)
        ->first();

        // Create an empty collection to store the processed data
        
        $resultsArrayBySku = [
            'sku' => $resultsArrayBySkuData->sku,
            'title' => $resultsArrayBySkuData->title,
            'prices' => $resultsArrayBySkuData->price,
            'images' => $resultsArrayBySkuData->image_1,
            'skuType' => 'Random',
            'vendorName' => 'roughcountry',
        ];

        $randomResultsArray = collect();

        foreach ($randomResultsArrayData as $item) {
            $processedData = [
                'sku' => $item->sku ?? '',
                'title' => $item->title ?? '',
                'prices' => $item->price ?? '',
                'images' => $item->image_1 ?? '',
                'skuType' => 'Random',
                'vendorName' => 'roughcountry',
            ];
            $randomResultsArray->push($processedData);
        }

        return view('product-detail',compact('resultsArrayBySku','randomResultsArray'));
    }

    public function getMakes(Request $request)
    {
        $year = $request->input('year');
        $makes = DB::table('vehicle_fitment')->where('startYear', $year)->pluck('make')->unique()->toArray();
        sort($makes);
        return response()->json($makes);
    }
    
    public function getModels(Request $request)
    {
        $make = $request->input('make');
        $models = DB::table('vehicle_fitment')->where('make', $make)->pluck('model')->unique()->toArray();
        sort($models);
        return response()->json($models);
    }
    
    
    

    public function search()
    {
        // Retrieve search query parameters
        $categories = request()->input('categories', []);
        $minPrice = request()->input('min_price') ?? 0;
        $maxPrice = request()->input('max_price');
        $searchQuery = request()->input('searchQuery');
        
        $year = request()->input('year');
        $make = request()->input('make');
        $model = request()->input('model');

        $type = request()->input('type');

        $wheelDiameter = request()->input('wheelDiameter');
        $wheelWidth = request()->input('wheelWidth');
        $boltPattern = request()->input('boltPattern');

        $tireHeight = request()->input('tireHeight');
        $tireWidth = request()->input('tireWidth');
        $tireDiameter = request()->input('tireDiameter');
        

    
        // Query to fetch general items based on the provided filters
        $query = DB::table('general');
    
        // Apply category filter if any categories are selected
        if ($categories) {
            $query->whereIn('category', $categories);
        }
    
        // Apply price filter if provided
        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }
    
        
    
        // Apply search query filter if provided
        if ($searchQuery == 'WHEEL TIRE Packages' ) {
            $query->orWhere('category', 'LIKE', "{$searchQuery}");
        }else{
            $keywords = explode(' ', $searchQuery); // Split search query into individual words
            
            foreach ($keywords as $keyword) {
                $query->orWhere('category', 'LIKE', "%{$keyword}%");
                // $query->orWhere('title', 'like', '%' . $keyword . '%');
            }
        }

        // Retrieve SKUs based on make, model, and year
        if ($make || $model || $year) {
            $skus = DB::table('vehicle_fitment')
                ->when($make, function ($query) use ($make) {
                    return $query->where('make', $make);
                })
                ->when($model, function ($query) use ($model) {
                    return $query->where('model', $model);
                })
                ->when($year, function ($query) use ($year) {
                    return $query->where('startyear', $year);
                })
                ->distinct()
                ->pluck('sku')
                ->toArray();
    
            $query->whereIn('sku', $skus);
        }

        // Retrieve Wheel by wheel
        if ($type == 'wheel') { // Use '==' for comparison, not '=' which is assignment

            $wheelDiameter_x_wheelWidth = $wheelDiameter . 'x' . $wheelWidth;

            // Extract bolt pattern from title
            preg_match('/\d{1,2}x\d{1,2}\.?\d*/', $boltPattern, $matches);
            $boltPattern = $matches[0] ?? null;

            $query->where('title', 'LIKE', "%{$wheelDiameter_x_wheelWidth}%")
            ->Where('title', 'LIKE', "%{$boltPattern}%")
            ->Where('title', 'LIKE', '%wheel%');
            
        }

        // Retrieve Wheel by tire
        if ($type == 'tire') { // Use '==' for comparison, not '=' which is assignment
            $query
            ->Where('height',"{$tireHeight}")
            ->Where('width',"{$tireWidth}")
            ->Where('category', 'LIKE', "%{$type}%");
        }




    
        // Get the total count of records
        $totalRecords = $query->count();
    
        // Define the number of items per page
        $recordsPerPage = 12;
    
        // Calculate the total number of pages
        $totalPages = ceil($totalRecords / $recordsPerPage);
    
        // Get the current page number
        $currentPage = request()->input('page', 1);
    
        // Calculate the offset to slice the items for the current page
        $offset = ($currentPage - 1) * $recordsPerPage;
    
        // Retrieve the items for the current page
        $paginatedCollection = $query->select('sku', 'title', 'price', 'image_1')
        ->offset($offset)
        ->limit($recordsPerPage)
        ->get();
    
        // Process retrieved general items
        $processedCollection = $paginatedCollection->map(function ($item) {
            return [
                'sku' => $item->sku ?? '',
                'title' => $item->title ?? '',
                'prices' => $item->price ?? '',
                'images' => $item->image_1 ?? '',
                'skuType' => 'Random',
                'vendorName' => 'roughcountry',
            ];
        });
    
        // Get unique years for dropdown
        $uniqueYears = DB::table('vehicle_fitment')
        ->select('startyear')
        ->groupBy('startyear')
        ->orderBy('startyear', 'desc')
        ->distinct()
        ->pluck('startyear');

        $uniqueProductByCategory = DB::table('general')
        ->select('category', DB::raw('MAX(image_1) as image_1'))
        ->groupBy('category')
        ->inRandomOrder() // Shuffle the results randomly
        ->take(13)        // Take 13 items
        ->get();
    

        $request = request();


    
        // Pass the processed collection, records per page, total pages, current page, unique makes, and search query to the view
        return view('filter-result', compact(
            'paginatedCollection',
            'processedCollection',
            'recordsPerPage',
            'totalPages',
            'currentPage',
            'uniqueYears',
            'searchQuery',
            'uniqueProductByCategory',
            'request'
        ));
    }



    
    
    
    
    
    
    
    
}