<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'product',
        'description',
        'price',
        'category_id',
        'user_id',
        'issold'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function show(Sale $sale)
    {
        $sale->load('images', 'category');
        return view('sales.show', compact('sale'));
    }
}