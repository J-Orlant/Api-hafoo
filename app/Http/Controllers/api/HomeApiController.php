<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeApiController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        $user = User::where('id', Auth::user()->id)->first();

        return response()->json([
            'code' => 200,
            'message' => 'Get data successfuly',
            'products' => $products,
            'categories' => $categories,
            'user' => $user
        ], 200);
    }
}
