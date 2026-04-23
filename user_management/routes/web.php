<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;

Route::redirect('/', '/login');

Route::view('/login', 'auth.login')->name('frontend.login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    if (! Auth::attempt($credentials)) {
        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    $request->session()->regenerate();

    $user = $request->user();

    if ($user?->hasRole('System Admin') || $user?->hasRole('Admin')) {
        return redirect()->route('users.index');
    }

    if ($user?->hasRole('Manager')) {
        return redirect()->route('dashboard.manager');
    }

    return redirect()->route('dashboard.user');
})->name('frontend.login.submit');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('frontend.login');
})->name('frontend.logout');

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::view('/dashboard/user', 'dashboard.user')->name('dashboard.user');
    Route::view('/dashboard/manager', 'dashboard.admin')->name('dashboard.manager')->middleware('role:Manager');
});

Route::middleware(['auth', 'role:System Admin,Admin', 'nocache'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('offices', OfficeController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('activity-logs', ActivityLogController::class)->only(['index', 'show', 'destroy']);
});
