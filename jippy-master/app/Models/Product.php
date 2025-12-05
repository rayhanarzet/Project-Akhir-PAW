<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'short_desc',
        'description',
        'category',
        'color',
        'sizes',
        'price',
        'close_po_date',
        'status',
        'image',
    ];
}
