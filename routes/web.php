<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
Route::get('/{any}', function () {
    return view('vue');
})->where('any', '.*');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


require __DIR__.'/auth.php';
Route::group([
    'as' => 'user.',
    'prefix' => 'user',
    'middleware'=>['auth','role:1'],
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'category.',
    'prefix' => 'category',
    'middleware'=>'role:1,2',
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
    'middleware'=>'auth',

], function() {
    Route::get('/', [OrderController::class, 'index'])->name('index')->middleware(['role:3']);
    Route::get('/dashboard', [OrderController::class, 'dashboard'])->name('dashboard')->middleware(['role:1,2']);
    Route::get('dashboard/{order}', [OrderController::class, 'dashboard_show'])->name('dashboard_show')->middleware(['role:1,2']);
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show')->middleware(["my_order"]);
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
    Route::get('/create', [MenuController::class, 'create'])->name('create')->middleware(['role:1,2']);
    Route::post('/', [MenuController::class, 'store'])->name('store')->middleware(['role:1,2']);
    Route::get('/{menu}', [MenuController::class, 'show'])->name('show');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit')->middleware(['role:1,2']);
    Route::post('/{menu}', [MenuController::class, 'update'])->name('update')->middleware(['role:1,2']);
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy')->middleware(['role:1,2']);
});

Route::group([
    'as' => 'basket.',
    'prefix' => 'basket',
    'middleware'=>['auth','role:3'],
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
    'middleware'=>'auth',
], function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/{profile}', [ProfileController::class, 'update'])->name('update');
});

Route::group([
    'as' => 'address.',
    'prefix' => 'address',
    'middleware'=>'auth',
], function() {
    Route::get('/create', [AddressController::class, 'create'])->name('create');
    Route::post('/', [AddressController::class, 'store'])->name('store');
    Route::get('/{address}/edit', [AddressController::class, 'edit'])->name('edit');
    Route::put('/{address}', [AddressController::class, 'update'])->name('update');
    Route::delete('/{address}', [AddressController::class, 'destroy'])->name('destroy');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
