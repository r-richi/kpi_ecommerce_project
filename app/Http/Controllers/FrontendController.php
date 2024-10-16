<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.pages.index');
    }
    public function shop(){
        $products = Product::all();
        return view('frontend.pages.shop', compact('products'));
    }
}
