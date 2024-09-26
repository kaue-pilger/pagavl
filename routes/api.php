<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Always before apiResource
Route::get('transactions/by-currency', [TransactionController::class, 'getTotalsByCurrency']);
Route::get('transactions/by-payment-methods', [TransactionController::class, 'getTotalsByPaymentMethods']);

Route::apiResource('transactions', TransactionController::class);    
