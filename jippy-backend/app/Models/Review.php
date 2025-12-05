<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',     // ⬅️ tambahkan ini
        'username',
        'rating',
        'summary',
        'texture',
        'expired',
        'image_path',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()          // ⬅️ relasi ke produk
    {
        return $this->belongsTo(Product::class);
    }
}
