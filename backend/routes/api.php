<?php

use App\Http\Controllers\Api\V1\ConfigurationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    */
    Route::get('configuration', [ConfigurationController::class, 'show'])->name('configuration.show');
    Route::put('configuration', [ConfigurationController::class, 'update'])->name('configuration.update');
});
