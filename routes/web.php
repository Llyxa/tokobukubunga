<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

    // Route::post('/insert', [BukuController::class, 'insert'])->name('insert');
    // Route::get('/tambah', [BukuController::class, 'tambah'])->name('tambah');
    // Route::get('/tampilkandata/{id}', [BukuController::class, 'tampilkandata'])->name('tampilkandata');
    // Route::post('/updatedata/{id}', [BukuController::class, 'updatedata'])->name('updatedata');
    // Route::get('/delete/{id}', [\App\Http\Controllers\ProdukController::class, 'delete'])->name('delete');
 
    // Route::get('/home', [BukuController::class, 'home'])->name('home');
    // Route::get('/detail/{id}', [BukuController::class, 'detail'])->name('detail')->name('detail');
    Route::get('/categories', [BukuController::class, 'categories'])->name('categories');
    // Route::get('/category/{category:kategori}', [BukuController::class, 'category'])->name('category');
    Route::get('/genres', [BukuController::class, 'genres'])->name('genres');
    // Route::get('/genre/{genre:genre}', [BukuController::class, 'genre'])->name('genre');
    // Route::get('/checkout', [BukuController::class, 'checkout'])->name('checkout');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Start Produk
Route::resource('produk', \App\Http\Controllers\ProdukController::class);
Route::resource('produk-detail',\App\Http\Controllers\ProdukDetailController::class);

//Start Master
Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
Route::resource('genre', \App\Http\Controllers\GenreController::class);
