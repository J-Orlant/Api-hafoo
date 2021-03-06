<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'transaction_id', 'price', 'quantity'];
    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
