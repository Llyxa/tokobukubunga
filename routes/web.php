<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CartController;
// use App\Http\Controllers\CartDetailController;

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

Route::get('/', function () {
    return view('welcome');
});
Illuminate\Support\Facades\Auth::routes();

    // Route::get('/checkout/{id}', [ProdukController::class, 'checkout'])->name('checkout');
    // Route::get('/keranjang', 'ProdukController@checkout');
    // Route::resource('detail-transaksi', \App\Http\Controllers\DetailTransaksiController::class);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::resource('produk', \App\Http\Controllers\ProdukController::class);
    Route::resource('cart', \App\Http\Controllers\CartController::class);
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class);

    Route::middleware('admin')->group(function () {
        Route::resource('kategori', \App\Http\Controllers\KategoriController::class)->except('show');
        Route::resource('genre', \App\Http\Controllers\GenreController::class)->except('show');
        Route::resource('penerbit', \App\Http\Controllers\PenerbitController::class)->except('show');
        Route::resource('cara_bayar', \App\Http\Controllers\CaraBayarController::class)->except('show');
        Route::resource('pengiriman', \App\Http\Controllers\PengirimanController::class)->except('show');
    });

    // Route::middleware('user')->group(function () {
    //     Route::resource('transaksi', \App\Http\Controllers\TransaksiController::class);
    //     // cart
    //     Route::resource('cart', \App\Http\Controllers\CartController::class);
    //     Route::patch('kosongkan/{id}', [App\Http\Controllers\CartController::class, 'kosongkan']);\
    // });

// Route::group(['middleware' => 'auth'], function() {
    // cart
    // Route::resource('cart', \App\Http\Controllers\CartController::class);
    // Route::patch('kosongkan/{id}', [App\Http\Controllers\CartController::class, 'kosongkan']);
    // cart detail
    // Route::resource('cartdetail', \App\Http\Controllers\CartDetailController::class);
//   });

    