<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Products
Route::get('products', [\App\Http\Controllers\API\ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [\App\Http\Controllers\API\ProductController::class, 'create'])->name('products.create');
Route::get('products/edit/{product}', [\App\Http\Controllers\API\ProductController::class, 'edit'])->name('products.edit');

// Categories
Route::get('categories', [\App\Http\Controllers\API\CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [\App\Http\Controllers\API\CategoryController::class, 'create'])->name('categories.create');
Route::get('categories/edit/{category}', [\App\Http\Controllers\API\CategoryController::class, 'edit'])->name('categories.edit');

// Attributes
Route::get('attributes', [\App\Http\Controllers\API\AttributeController::class, 'index'])->name('attributes.index');
Route::get('attributes/create', [\App\Http\Controllers\API\AttributeController::class, 'create'])->name('attributes.create');
Route::get('attributes/edit/{attribute}', [\App\Http\Controllers\API\AttributeController::class, 'edit'])->name('attributes.edit');
