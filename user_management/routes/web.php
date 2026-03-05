<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

Route::redirect('/', '/users');

Route::resource('users', UserController::class);
Route::resource('offices', OfficeController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class)->except(['destroy']);
Route::resource('activity-logs', ActivityLogController::class)->only(['index', 'show', 'destroy']);
