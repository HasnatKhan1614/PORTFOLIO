<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ShopController,
    GalleryController,
    AboutUsController,
    CartController,
    ContactUsController,
    BlogController,
    PaymentController,
    OrderController,
    
};

use App\Http\Controllers\User\{
    AuthController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Route::get('register', [AuthController::class, 'showRegistrationForm']);

Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showLoginForm']);

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index']);

// Route::get('/login', [LoginController::class, 'login']);    

Route::get('/shop', [ShopController::class, 'index']);

Route::get('/wp-product-detail/{sku}', [ShopController::class, 'wp_product_detail']);

Route::get('/rc-product-detail/{sku}', [ShopController::class, 'rc_product_detail']);

Route::match(['get', 'post'], '/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/gallery-detail/{id}', [GalleryController::class, 'gallery_detail']);

Route::get('/blog', [BlogController::class, 'index']);

Route::get('/blog-detail', [BlogController::class, 'blog_detail']);

Route::get('/contact-us', [ContactUsController::class, 'index']);

Route::get('/about-us', [AboutUsController::class, 'index']);

Route::get('/cart', [CartController::class, 'index']);

Route::get('/checkout', [CartController::class, 'checkout']);
    
Route::match(['get', 'post'], '/search', [ShopController::class, 'search'])->name('search');

Route::get('/getMakes', [ShopController::class, 'getMakes'])->name('getMakes');

Route::get('/getModels', [ShopController::class, 'getModels'])->name('getModels');

// Route for displaying the form
Route::get('/order/create', [OrderController::class, 'create']);

// Route for storing the order data (AJAX request)
Route::resource('order', OrderController::class);

//payment
Route::controller(PaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::get('/payment/success', [OrderController::class, 'payment_success'])->name('stripe_success');

Route::get('/payment/cancel',function(){
    return view('cancel');
});


