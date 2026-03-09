<?php

use App\Http\Controllers\Api\ActivityLogApiController;
use App\Http\Controllers\Api\OfficeApiController;
use App\Http\Controllers\Api\PermissionApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware(['auth:sanctum', 'role:System Admin,Admin'])->name('api.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('users', UserApiController::class);
    Route::apiResource('offices', OfficeApiController::class);
    Route::apiResource('roles', RoleApiController::class);
    Route::apiResource('permissions', PermissionApiController::class)->except(['destroy']);
    Route::apiResource('activity-logs', ActivityLogApiController::class)->only(['index', 'show', 'destroy']);
});
