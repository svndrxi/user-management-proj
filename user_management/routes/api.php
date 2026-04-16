<?php

use App\Http\Controllers\Api\ActivityLogApiController;
use App\Http\Controllers\Api\OfficeApiController;
use App\Http\Controllers\Api\PayslipApiController;
use App\Http\Controllers\Api\PermissionApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware(['auth:sanctum', 'role:System Admin,Admin'])->name('api.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('users/{user}/unarchive', [UserApiController::class, 'unarchive'])->name('users.unarchive');
    Route::delete('users/{user}/soft-delete', [UserApiController::class, 'softDelete'])->name('users.soft-delete');
    Route::apiResource('users', UserApiController::class);
    Route::apiResource('offices', OfficeApiController::class);
    Route::apiResource('roles', RoleApiController::class);
    Route::apiResource('permissions', PermissionApiController::class)->except(['destroy']);
    Route::apiResource('activity-logs', ActivityLogApiController::class)->only(['index', 'show', 'destroy']);
    Route::post('payslips/import', [PayslipApiController::class, 'import'])->name('payslips.import');
    Route::post('payslips/{payslip}/send-mail', [PayslipApiController::class, 'sendMail'])->name('payslips.send-mail');
    Route::post('payslips/bulk-send-mail', [PayslipApiController::class, 'bulkSendMail'])->name('payslips.bulk-send-mail');
    Route::post('payslips/bulk-zip', [PayslipApiController::class, 'bulkZip'])->name('payslips.bulk-zip');
    Route::post('payslips/bulk-preview', [PayslipApiController::class, 'bulkPreview'])->name('payslips.bulk-preview');
    Route::post('payslips/bulk-pdf', [PayslipApiController::class, 'bulkPdf'])->name('payslips.bulk-pdf');
    Route::get('payslips/{payslip}/preview', [PayslipApiController::class, 'preview'])->name('payslips.preview');
    Route::get('payslips/{payslip}/pdf', [PayslipApiController::class, 'pdf'])->name('payslips.pdf');
    Route::post('payslips/{payslip}/unarchive', [PayslipApiController::class, 'unarchive'])->name('payslips.unarchive');
    Route::delete('payslips/{payslip}/soft-delete', [PayslipApiController::class, 'softDelete'])->name('payslips.soft-delete');
    Route::apiResource('payslips', PayslipApiController::class);
});
