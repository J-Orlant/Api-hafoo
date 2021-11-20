<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request){
        if ($request->search) {
            $categories = Category::where('name', 'LIKE', '%' . $request->search . '%')->paginate(10)->withQueryString();
        }else{
            $categories = Category::paginate(10);
        }
        $check = $categories->first();
        return view('admin.category.category', compact('categories', 'check'));
    }
    
    public function store(Request $request){
        $data = $request->validate([
            'image' => 'required|image|file|max:1024',
            'name' => 'required'
        ]);
        $data['image'] = $request->file('image')->store('category-image');
        Category::create($data);
        return redirect(route('categories'))->with('success', 'Category has been created');
    }

    public function edit(Category $category){
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category){
        $data = $request->validate([
            'image' => 'image|file|max:2048',
            'name' => 'required'
        ]);
        if($request->hasFile('image')){
            Storage::delete($category->image);
            $data['image'] = $request->file('image')->store('category-image');
        }
        $category->update($data);
        return redirect(route('categories'))->with('success', 'Category has been updated');
    }

    public function delete(Category $category){
        Storage::delete($category->image);
        $category->delete();
        return redirect(route('categories'))->with('success', 'Category has been deleted');
    }
}
