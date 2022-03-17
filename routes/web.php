<?php

use App\Http\Controllers\CreateController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create', [CreateController::class, 'index'])->name('create');
Route::post('/albom', [CreateController::class, 'albom'])->name('albom');
Route::post('/albom', [CreateController::class, 'create'])->name('create.albom');

//Auth
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'register'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/user', [UserController::class, 'show'])->name('user.show')->middleware(['auth', 'verified']);

Route::get('/email/verify', function () {
    return view('user.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
