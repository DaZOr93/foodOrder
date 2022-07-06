<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuController;

use App\Http\Controllers\Api\OrderController;
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

});
Route::group([
    'as' => 'category.',
    'prefix' => 'category',
], function() {
    Route::get('/', [CategoryController::class, 'index'])->name('index');

});
Route::group([
    'as' => 'order.',
    'prefix' => 'order',
], function() {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');

});
