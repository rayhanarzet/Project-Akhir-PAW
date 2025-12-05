<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PreorderController extends Controller
{
    /**
     * Ambil semua produk preorder dengan filter kategori (opsional)
     */
    public function index(Request $request)
    {
        // Ambil query parameter ?category=...
        $category = $request->query('category');

        // Siapkan query builder
        $query = Product::query();

        // Filter category jika ada
        if (!empty($category)) {
            $query->where('category', 'like', '%' . $category . '%');
        }

        // Return sebagai JSON
        return response()->json(
            $query->latest()->get(),
            200
        );
    }
}

