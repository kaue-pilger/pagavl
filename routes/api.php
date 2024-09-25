<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Always before apiResource
Route::get('transactions/by-currency', [TransactionController::class, 'getTotalsByCurrency']);
Route::get('transactions/test', function () {    return response()->json(['message' => 'Teste de rota funcionando!']);});

Route::apiResource('transactions', TransactionController::class);    
