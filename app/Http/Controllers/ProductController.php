<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ProductController extends Controller
{
    public function index(Request $request){
        if($request->search){
            $products = Product::with('category')->where('name', 'LIKE', '%' . $request->search . '%')->withQueryString()->paginate(10);
        }else{
            $products = Product::with('category')->paginate(10);
        }
        $check = $products->first();
        return view('admin.product.product', compact('products', 'check'));
    }

    public function create(){
        $categories = Category::all();
        $check = Category::first();
        return view('admin.product.create', compact('categories', 'check'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'category_id' => 'required',
            'image' => 'required|image|file|max:2048',
            'name' => 'required|unique:App\Models\Product,name|max:255',
            'description' => 'required',
            'price' => 'required|integer',
        ]);
        $data['topping'] = $request->topping;
        $data['image'] = $request->file('image')->store('product-image');
        $product = Product::create($data);
        return redirect(route('products'))->with('success', 'New product has been added');
    }

    public function edit(Product $product){
        $categories = Category::all();
        return view('admin.product.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product){
        $rules = [
            'category_id' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
        ];
        if($request->name === $product->name){
            $rules['name'] = 'required';
        }else{
            $rules['name'] = 'required|unique:App\Models\Product,name';
        }
        $data = $request->validate($rules);

        if($request->hasFile('image')){
            Storage::delete($product->image);
            $data['image'] = $request->file('image')->store('product-image');
        }
        $data['topping'] = $request->topping;
        $product->update($data);
        return redirect(route('products'))->with('success', 'Product has been updated');
    }

    public function createSlug(Request $request){
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json([
            'slug' => $slug
        ]);
    }

    public function delete(Product $product){
        $product->delete();
        return redirect(route('products'))->with('success', 'Product Removed Successfully');
    }
}
