<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProductController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin/home', [HomeController::class, 'admin'])->name('admin:home')->middleware('isAdmin');

Route::get('/product/index', [ProductController::class, 'index'])->name('product:index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product:create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product:store');
Route::get('/product/destroy/{product}', [ProductController::class, 'destroy'])->name('product:destroy');
Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product:edit');
Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product:update');
