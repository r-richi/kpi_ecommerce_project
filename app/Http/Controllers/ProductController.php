<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::all();
        return view('backend.pages.products.index', compact('products'));
    }

    // Show form to create a new product
    public function create()
    {
        return view('backend.pages.products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category = $request->category;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time().'.'.$image->extension();
            $image->storeAs('products', $fileName, 'public');
            $product->image = $fileName;
        }
      
        $product->save();

        return redirect()->route('admin.products.index');
    }

    // Show a single product
    // public function show($id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('backend.pages.products.show', compact('product'));
    // }

    // Show form to edit a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.pages.products.edit', compact('product'));
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category = $request->category;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time().'.'.$image->extension();
            $image->storeAs('products', $fileName, 'public');
            $product->image = $fileName;
        }
      
        $product->save();
        return redirect()->route('admin.products.index');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
