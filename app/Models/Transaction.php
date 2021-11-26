<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'invoice_code', 'address', 'total_price', 'total_quantity', 'shipping_price', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }
}
