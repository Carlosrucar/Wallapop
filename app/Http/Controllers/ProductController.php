<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
    
        if ($query) {
            $products = Sale::where('product', 'LIKE', "%{$query}%")
                          ->where('issold', false)
                          ->with(['category', 'user'])
                          ->paginate(12); // Change get() to paginate()
        } else {
            $products = Sale::where('issold', false)
                          ->with(['category', 'user'])
                          ->paginate(12); // Change get() to paginate()
        }
    
        return view('products.index', compact('products'));
    }
}