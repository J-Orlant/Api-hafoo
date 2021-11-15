<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'slug', 'price', 'description'];
    public function category(){
        return $this->belongsTo(Product::class);
    }
    public function galleries(){
        return $this->hasMany(Gallery::class);
    }
}
