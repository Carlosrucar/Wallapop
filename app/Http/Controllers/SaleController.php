<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    
    public function index(Request $request)
{

    $query = Sale::where('issold', false)->with(['category', 'user']);
    
    // Filtrado
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }
    
    if ($request->filled('price_min')) {
        $query->where('price', '>=', floatval($request->price_min));
    }
    
    if ($request->filled('price_max')) {
        $query->where('price', '<=', floatval($request->price_max));
    }
    
    // Ordenamiento
    $allowedSortFields = ['created_at', 'price'];
    $allowedDirections = ['asc', 'desc'];
    
    $sort = in_array($request->get('sort'), $allowedSortFields) 
        ? $request->get('sort') 
        : 'created_at';
        
    $direction = in_array($request->get('direction'), $allowedDirections) 
        ? $request->get('direction') 
        : 'desc';
    
    $query->orderBy($sort, $direction);
    
    $sales = $query->paginate(12)->withQueryString();
    $categories = Category::all();
    
    return view('sales.index', compact('sales', 'categories'));
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

public function edit(Sale $sale)
{
    $categories = Category::all();
    return view('sales.edit', compact('sale', 'categories'));
}

public function update(Request $request, Sale $sale)
{
    $validatedData = $request->validate([
        'product' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    $sale->update($validatedData);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('sales', 'public');
            Image::create([
                'sale_id' => $sale->id,
                'route' => $path
            ]);
        }
    }

    return redirect()->route('sales.show', $sale)
        ->with('success', 'Producto actualizado correctamente');
}

public function markAsSold(Sale $sale)
{
    $sale->update(['issold' => true]);
    return redirect()->back()->with('success', 'Producto marcado como vendido');
}
    
}