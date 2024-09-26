<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::all();
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
        $transaction = Transaction::create($request->all());
        return response()->json($transaction, 201);
    }

    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    public function getTotalsByCurrency()
    {
        $totals = Transaction::select('currency', DB::raw('SUM(amount) as total'))
            ->groupBy('currency')
            ->get();
    
        return response()->json($totals);
    }

    public function getAllAmounts()
    {
        $amounts = Transaction::select(DB::raw('SUM(amount) as amounts'))
            ->get();
    
        return $amounts;
    }

    public function getTotalsByPaymentMethods()
    {
        $payment_methods = Transaction::select('payment_method', DB::raw('COUNT(*) as total'))
            ->groupBy('payment_method')
            ->get()
            ->pluck('total', 'payment_method'); // Pluck to create the key-value format
        
        return response()->json($payment_methods);
    }
    

    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());
        return response()->json($transaction, 200);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(null, 204);
    }
}
