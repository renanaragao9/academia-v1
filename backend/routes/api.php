<?php

use App\Http\Controllers\Api\V1\AssessmentController;
use App\Http\Controllers\Api\V1\ConfigurationController;
use App\Http\Controllers\Api\V1\CustomerRegistrationController;
use App\Http\Controllers\Api\V1\MealPlanController;
use App\Http\Controllers\Api\V1\MonthlyFeeController;
use App\Http\Controllers\Api\V1\PurchaseController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\TrainingSheetController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function () {
    Route::get('configuration', [ConfigurationController::class, 'show'])->name('configuration.show');
    Route::post('customer_registrations', [CustomerRegistrationController::class, 'store']);

    Route::prefix('students')->group(function () {
        Route::post('show', [StudentController::class, 'show'])->name('students.show');
        Route::get('{student}/dashboard', [StudentController::class, 'dashboard'])->name('students.dashboard');
    });

    Route::post('training_sheets', [TrainingSheetController::class, 'index'])->name('training_sheets.index');
    Route::post('assessments', [AssessmentController::class, 'index'])->name('assessments.index');
    Route::post('meal_plans', [MealPlanController::class, 'index'])->name('meal_plans.index');
    Route::post('monthly_fees', [MonthlyFeeController::class, 'index'])->name('monthly_fees.index');
    Route::post('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
});
