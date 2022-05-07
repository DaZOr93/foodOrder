<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
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

Route::get('/1', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group([
    'as' => 'category.',
    'prefix' => 'category',
], function() {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::post('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'orders.',
    'prefix' => 'orders',
], function() {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/dashboard', [OrderController::class, 'dashboard'])->name('dashboard');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    Route::post('/{id}/status', [OrderController::class, 'status'])->name('status');
    Route::put('/{order}', [OrderController::class, 'update'])->name('update');
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
});

Route::get('/', [MenuController::class, 'index'])->name('index');

Route::group([
    'as' => 'menu.',
    'prefix' => 'menu',
], function() {
    Route::get('/category/{category}', [MenuController::class, 'category'])->name('category');
    Route::get('/create', [MenuController::class, 'create'])->name('create');
    Route::post('/', [MenuController::class, 'store'])->name('store');
    Route::get('/{menu}', [MenuController::class, 'show'])->name('show');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
    Route::post('/{menu}', [MenuController::class, 'update'])->name('update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'basket.',
    'prefix' => 'basket',
], function() {
    Route::get('/', [BasketController::class, 'index'])->name('index');
    Route::get('/create', [BasketController::class, 'create'])->name('create');
    Route::post('/', [BasketController::class, 'store'])->name('store');
    Route::get('/{basket}', [BasketController::class, 'show'])->name('show');
    Route::post('/{menu_id}/', [BasketController::class, 'add'])->name('add');
    Route::put('/{basket}', [BasketController::class, 'update'])->name('update');
    Route::delete('/{basket}', [BasketController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'profile.',
    'prefix' => 'profile',
], function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/{profile}', [ProfileController::class, 'update'])->name('update');
});

Route::group([
    'as' => 'address.',
    'prefix' => 'address',
], function() {
    Route::get('/create', [AddressController::class, 'create'])->name('create');
    Route::post('/', [AddressController::class, 'store'])->name('store');
    Route::get('/{address}/edit', [AddressController::class, 'edit'])->name('edit');
    Route::put('/{address}', [AddressController::class, 'update'])->name('update');
    Route::delete('/{address}', [AddressController::class, 'destroy'])->name('destroy');
});

