<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PreorderController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $query = Product::query();

        if (!empty($category)) {
            $query->where('category', 'like', '%' . $category . '%');
        }

        return response()->json(
            $query->latest()->get(),
            200
        );
    }
}

