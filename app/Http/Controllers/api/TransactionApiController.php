<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionApiController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
           'invoice_code' => 'unique:App\Models\Transaction,invoice_code', 
           'address' => 'required', 
           'total_price' => 'required', 
           'total_quantity' => 'required', 
           'shipping_price' => 'required', 
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['invoice_code'] = Auth::user()->id . rand(0000000, 9999999);
        $transaction = Transaction::create($data);

        $transaction_id = Transaction::where('user_id', Auth::user()->id)->latest()->first();
        foreach ($request->product_id as $product ) {
            Order::create([
                'product_id' => $product['product_id'],
                'transaction_id' => $transaction_id->id,
                'price' => $product['price'],
                'quantity' => $product['quantity'],
            ]);
        }
        $orders = Order::where('transaction_id', $transaction_id->id)->latest()->get();
        return response()->json([
            'message' => 'Successful payment',
            'transaction' => $transaction,
            'order' =>$orders
        ], 200);
    }
}
