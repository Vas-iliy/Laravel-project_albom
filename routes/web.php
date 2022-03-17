<?php

use App\Http\Controllers\CreateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create', [CreateController::class, 'index'])->name('create');
Route::post('/albom', [CreateController::class, 'albom'])->name('albom');
Route::post('/new-albom', [CreateController::class, 'create'])->name('create.albom');
Route::post('/send', [CreateController::class, 'store'])->name('create.send');
Route::get('/edit{id}', [CreateController::class, 'edit'])->name('edit')->middleware('auth');
Route::put('/update/{id}', [CreateController::class, 'update'])->name('update')->middleware('auth');
Route::delete('/destroy{id}', [CreateController::class, 'destroy'])->name('destroy')->middleware('auth');

//Auth
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'register'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
