<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'CheckIsAdmin'])->group(function () {
	Route::get('/', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
	Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('adminUsers');
	Route::get('/products', [App\Http\Controllers\AdminController::class, 'products'])->name('adminProducts');
	Route::get('/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('adminCategories');
	Route::get('/enterAsUser/{id}', [App\Http\Controllers\AdminController::class, 'enterAsUser'])->name('enterAsUser');
});


Auth::routes();


Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/save', [App\Http\Controllers\ProfileController::class, 'save'])->name('saveProfile');
Route::get('orders', [App\Http\Controllers\ProfileController::class, 'orders'])->name('orders');

Route::get('/profileProduct/{id}', [App\Http\Controllers\ProfileProductController::class, 'profileProduct'])->name('profileProduct');
Route::post('/profileProduct/save', [App\Http\Controllers\ProfileProductController::class, 'save'])->name('saveProfileProduct');


Route::get('/category/{category}', [App\Http\Controllers\HomeController::class, 'category'])->name('category');

Route::get('/profileCategory/{id}', [App\Http\Controllers\ProfileCategoryController::class, 'profileCategory'])->name('profileCategory');
Route::post('/profileCategory/save', [App\Http\Controllers\ProfileCategoryController::class, 'save'])->name('saveProfileCategory');

Route::post('/createCategory', [AdminController::class, 'createCategory'])->name('createCategory');
Route::post('/deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
Route::post('/exportCategories', [AdminController::class, 'exportCategories'])->name('exportCategories');
Route::post('/importCategories', [AdminController::class, 'importCategories'])->name('importCategories');
Route::post('/createProduct', [AdminController::class, 'createProduct'])->name('createProduct');
Route::post('/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
Route::post('/exportProducts', [AdminController::class, 'exportProducts'])->name('exportProducts');
Route::post('/importProducts', [AdminController::class, 'importProducts'])->name('importProducts');
Route::post('/deleteExportFile', [AdminController::class, 'deleteExportFile'])->name('deleteExportFile');

Route::prefix('cart')->group(function () {
	Route::get('/', [CartController::class, 'cart'])->name('cart');
	Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
	Route::post('/removeFromCart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
	Route::post('/createOrder', [CartController::class, 'createOrder'])->name('createOrder');
	Route::post('/repeatOrder', [CartController::class, 'repeatOrder'])->name('repeatOrder');
});

Route::prefix('roles')->group(function () {
	Route::post('/add', [AdminController::class, 'addRole'])->name('addRole');
	Route::post('/delete', [AdminController::class, 'deleteRole'])->name('deleteRole');
	Route::post('/applyRole/{id}', [AdminController::class, 'applyRole'])->name('applyRole');
	Route::post('/addRoleToUser', [AdminController::class, 'addRoleToUser'])->name('addRoleToUser');
});
