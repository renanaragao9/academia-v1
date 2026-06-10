<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pdf/monthly-fee/{uuid}', [PdfController::class, 'monthlyFee'])->name('pdf.monthly-fee');
