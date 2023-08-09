<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::resource('profile', App\Http\Controllers\ProfileController::class)->only('edit', 'update');
    Route::resource('lots', App\Http\Controllers\LotController::class);
    Route::delete('lot-images/{id}', [App\Http\Controllers\LotImageController::class, 'destroy'])->name('lot-images.destroy');
    Route::get('profile/add-money', [App\Http\Controllers\ProfileController::class, 'topUpBalance'])->name('profile.addMoney');
    Route::post('bid', [App\Http\Controllers\BidController::class, 'store'])->name('bid');
    Route::get('/only-bid',[App\Http\Controllers\OnlyBiddedController::class, 'index'])->name('onlybid');
    Route::post('/send-winner', [App\Http\Controllers\LotController::class, 'winner'])->name('winner');
    Route::get('/bid-won', [App\Http\Controllers\BidController::class, 'won'])->name('won');
    Route::post('/checkout-save/{bid_id}', [App\Http\Controllers\CheckoutController::class, 'getToken'])->name('getToken');
    Route::get('/checkout/{bid_id}', [App\Http\Controllers\CheckoutController::class, 'checkoutPage'])->name('checkoutpage');
    Route::get('/success/{bid_id}/{user_id}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('success_page');

    Route::get('/purchases', [App\Http\Controllers\PurchaseController::class, 'index'])->name('purchases');

    Route::get('/images', [App\Http\Controllers\LotImageController::class, 'getimage'])->name('getimage');

    

    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['can:edit users']
    ], function () {
        Route::resource('users', \App\Http\Controllers\Admin\UsersController::class)->only('index', 'edit', 'update');
        Route::resource('lots', \App\Http\Controllers\Admin\LotsController::class)->only('index', 'destroy');
    });
});

Route::post('/search-lots', [App\Http\Controllers\LotController::class, 'search'])->name('search-lot');

require __DIR__ . '/auth.php';
