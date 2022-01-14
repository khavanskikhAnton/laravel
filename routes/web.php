<?php

use App\Http\Controllers\HomeController;
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

Route::prefix('admin')->middleware('CheckIsAdmin')->group(function() {
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('adminUsers');
    Route::get('/products', [App\Http\Controllers\AdminController::class, 'products'])->name('adminProducts');
    Route::get('/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('adminCategories');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

