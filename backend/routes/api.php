<?php

use App\Http\Controllers\Api\V1\ConfigurationController;
use App\Http\Controllers\Api\V1\CustomerRegistrationController;
use App\Http\Controllers\Api\V1\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function () {
    Route::get('configuration', [ConfigurationController::class, 'show'])->name('configuration.show');
    Route::post('customer_registrations', [CustomerRegistrationController::class, 'store']);

    Route::prefix('students')->group(function () {
        Route::post('show', [StudentController::class, 'show'])->name('students.show');
        Route::get('{student}/dashboard', [StudentController::class, 'dashboard'])->name('students.dashboard');
    });
});
