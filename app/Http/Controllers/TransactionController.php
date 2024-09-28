<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TransactionController extends Controller
{
  public function index()
  {
    $transactions = Transaction::all();

    return response()->json($transactions);
  }

  public function create() 
  {
    $transactions = Transaction::all();
    
    return Inertia::render('Transactions/Index', [
        'transactions' => $transactions,
    ]);
  }

  public function store(Request $request)
  {
    $validatedRequest = $request->validate([
      'amount' => 'required|numeric',
      'currency' => 'required|string',
      'payment_method' => 'required|numeric',
      'merchant_id' => 'required|numeric',
      'order_id' => 'required|string'
    ]);

    $transaction = Transaction::create($validatedRequest);
    return response()->json($transaction, 201);
  }

  public function show(int $id)
  {
    $transactionById = Transaction::find($id);

    if (!$transactionById) 
      return response()->json(['message' => 'Transaction not found'], 404);

    return response()->json($transactionById);
  }  

  public function update(Request $request, Transaction $transaction)
  {
    $transaction->update($request->all());

    return response()->json($transaction);
  }

  public function destroy(Transaction $transaction)
  {
    $transaction->delete();

    return response()->json(null, status: 204);
  }

  public function getTotalsByCurrencies()
  {
    try {
      return response()->json(Transaction::getTotalsByCurrencies());
    } 
    catch (\Exception $e) 
    {
      Log::error('Failed to fetch, error message: ' . $e->getMessage());
      return response()->json(['error' => 'Failed to fetch totals by currency'], 500);
    }
  }   

  public function getTotalsByPaymentMethods()
  {
    try {
      return response()->json(Transaction::getTotalsByPaymentMethods());
    } 
    catch (\Exception $e) 
    {
      Log::error('Failed to fetch, error message: ' . $e->getMessage());
      return response()->json(['error' => 'Failed to fetch totals by payment method'], 500);
    }
  }
}
