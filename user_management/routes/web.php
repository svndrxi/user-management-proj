<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::middleware('guest')->group(function () {
    Route::view('/', 'frontend.login')->name('frontend.login');
    Route::post('/login', [AuthController::class, 'login'])->name('frontend.login.submit');
});

Route::middleware('auth')->group(function () {
    Route::view('/admin-home', 'frontend.admin_home')->name('frontend.admin.home');
    Route::view('/user-home', 'frontend.users_home')->name('frontend.user.home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('frontend.logout');
});

/*
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    return back()->with('success', 'Login form submitted successfully.');
});


Route::middleware(['auth'])->group(function () {

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Profile (Read Only)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

});
 */