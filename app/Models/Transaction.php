<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
  use HasFactory;

  protected $fillable = ['amount', 'currency', 'payment_method', 'merchant_id', 'order_id', 'date'];

  public static function getTotalsByCurrencies()
  {
    $totalsByCurrencies = Transaction::select('currency', DB::raw('SUM(amount) as total'))
      ->groupBy('currency')
      ->get();

    return $totalsByCurrencies;
  }
  
  public static function getTotalsByPaymentMethods()
  {
      $totalsByPaymentMethods = Transaction::select('payment_method', DB::raw('COUNT(*) as total'))
        ->groupBy('payment_method')
        ->get()
        ->pluck('total', 'payment_method'); // Pluck to create the key-value format
      
      return $totalsByPaymentMethods;
  }

}
