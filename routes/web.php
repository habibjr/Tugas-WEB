<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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


Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/postlogin',[AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth'], function()
{
    Route::get('/home',[HomeController::class, 'index'])->name('home');
    Route::get('/create',[HomeController::class, 'create'])->name('home.create');
    Route::post('/store',[HomeController::class, 'store'])->name('home.store');
    Route::get('/edit/{id}',[HomeController::class, 'edit'])->name('home.edit');
    Route::post('/update/{id}',[HomeController::class, 'update'])->name('home.update');
    Route::get('/destroy/{id}',[HomeController::class, 'destroy'])->name('home.destroy');
});