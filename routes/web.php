<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('ytd.welcome');
});

// routes/web.php
Route::get('/demo', [DemoController::class, 'show'])
->middleware('guest')
->name('demo');
Route::post('/login-submit', [DemoController::class, 'loginConfirm'])->name('loginConfirm');
Route::get('/logout', [DemoController::class, 'logout'])->name('logout');
Route::post('/registerConfirm', [DemoController::class, 'registerConfirm'])->name('registerConfirm');

Route::get('/users',[FlightController::class,'users']);
Route::group(['middleware' => 'isLoggedIn'], function () {
     Route::get('/dashboard', [DemoController::class, 'dashboard'])->name('dashboard');
     Route::get('/createProduct', [ProductController::class, 'createProduct'])->name('createProduct');
     Route::post('/submitProduct', [ProductController::class, 'submitProductone'])->name('submitProduct');
     Route::get('/editProduct/{id?}', [ProductController::class, 'editProduct'])->name('editProduct');
     Route::post('/updateProduct/{id?}', [ProductController::class, 'updateProduct'])->name('updateProduct');
     Route::get('/deleteProduct/{id?}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');

});
