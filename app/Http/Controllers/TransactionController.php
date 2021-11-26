<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index(Request $request){
        if($request->search){
            $transactions = Transaction::with('user')->where('name', 'LIKE', '%' . $request->search . '%')->withQueryString()->paginate(10);
        }else{
            $transactions = Transaction::with('user')->paginate(10);
        }
        $check = $transactions->first();
        return view('admin.transaction.transaction', compact('check', 'transactions'));
    }

    public function detail(Transaction $transaction){
        $orders = Order::with('product')->where('transaction_id', $transaction->id)->paginate(10);
        $transaction->with('user');
        return view('admin.transaction.detail', compact('transaction', 'orders'));
    }

    public function status_update(Transaction $transaction){
        if($transaction->status == 0){
            $transaction->update([
                'status' => 1,
            ]);
        }else if($transaction->status == 1){
            $transaction->update([
                'status' => 2,
            ]);
        }
        return redirect(route('transactions.detail', $transaction->id));
    }
}
