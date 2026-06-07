<?php

use App\Http\Controllers\Api\V1\ConfigurationController;
use App\Http\Controllers\Api\V1\CustomerRegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function () {
    Route::get('configuration', [ConfigurationController::class, 'show'])->name('configuration.show');
    Route::post('customer_registrations', [CustomerRegistrationController::class, 'store']);
});
