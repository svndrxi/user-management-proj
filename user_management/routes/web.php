<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('profile.show');
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