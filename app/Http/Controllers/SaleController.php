<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    
    public function index()
    {
        $sales = Sale::where('issold', false)
            ->with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('sales.create', compact('categories'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'product' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Set a default user_id since we don't want authentication
    $validatedData['user_id'] = 1; // Use a default user ID

    $sale = Sale::create($validatedData);

    // Guardar imágenes si se envían en el request
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('sales', 'public');

            Image::create([
                'sale_id' => $sale->id,
                'route' => $path,
            ]);
        }
    }

    return redirect()->route('sales.index')
        ->with('success', 'Producto publicado correctamente');
}

public function show(Sale $sale)
{
    return view('sales.show', compact('sale'));
}

public function destroy(Sale $sale)
{
    $sale->delete();
    return redirect()->route('sales.index')
        ->with('success', 'Publicación eliminada correctamente');
}
    
    
}