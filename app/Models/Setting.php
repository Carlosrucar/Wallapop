<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'maxfiles'];
    
    // Since this table doesn't use timestamps, we need to specify this
    public $timestamps = false;
}