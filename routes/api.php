<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuController;

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'as' => 'menu.',
    'prefix' => 'menu',
], function() {
    Route::get('/', [MenuController::class, 'index'])->name('index');
    Route::get('/category/{category}', [MenuController::class, 'category'])->name('index');
    Route::get('/{menu}', [MenuController::class, 'edit'])->name('edit')->middleware(['role:1,2']);
    Route::post('/update/{menu}', [MenuController::class, 'update'])->name('update')->middleware(['role:1,2']);
    Route::post('/add', [MenuController::class, 'store'])->name('store')->middleware(['role:1,2']);
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy')->middleware(['role:1,2']);
});
Route::group([
    'as' => 'category.',
    'prefix' => 'category',
], function() {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/{category}', [CategoryController::class, 'edit'])->name('edit')->middleware(['role:1,2']);
    Route::post('/update/{category}', [CategoryController::class, 'update'])->name('update')->middleware(['role:1,2']);
    Route::post('/add', [CategoryController::class, 'store'])->name('store')->middleware(['role:1,2']);
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy')->middleware(['role:1,2']);

});
Route::group([
    'as' => 'order.',
    'prefix' => 'order',
    'middleware'=>'auth:sanctum',
], function() {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::post('/status/{id}', [OrderController::class, 'status'])->name('status');

});

Route::group([
    'as' => 'basket.',
    'prefix' => 'basket',
    'middleware'=>'auth:sanctum',
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
    'as' => 'address.',
    'prefix' => 'address',
    'middleware'=>'auth:sanctum',
], function() {
    Route::get('/', [AddressController::class, 'index'])->name('index');
    Route::post('/', [AddressController::class, 'store'])->name('store');
    Route::get('/{address}/edit', [AddressController::class, 'edit'])->name('edit');
    Route::put('/{address}', [AddressController::class, 'update'])->name('update');
    Route::delete('/{address}', [AddressController::class, 'destroy'])->name('destroy');
});
Route::group([
    'as' => 'profile.',
    'prefix' => 'profile',
    'middleware'=>'auth:sanctum',
], function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
});
