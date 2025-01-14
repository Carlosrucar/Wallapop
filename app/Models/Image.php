<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['route', 'sale_id'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}