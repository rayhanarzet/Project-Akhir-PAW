<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return Product::orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'close_po_date' => 'required|date',
            'image' => 'nullable|image|max:2048'
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $filename = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/products'), $filename);
        }

        $p = Product::create([
            'name' => $request->name,
            'short_desc' => $request->short_desc,
            'description' => $request->description,
            'category' => $request->category,
            'color' => $request->color,
            'sizes' => $request->sizes,
            'price' => $request->price,
            'close_po_date' => $request->close_po_date,
            'status' => $request->status ?? 1,
            'image' => $filename
        ]);

        return response()->json(['success' => true, 'data' => $p]);
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        $p = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'close_po_date' => 'required|date',
            'image' => 'nullable|image|max:2048'
        ]);

        $filename = $p->image;
        if ($request->hasFile('image')) {
            $filename = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/products'), $filename);
        }

        $p->update([
            'name' => $request->name,
            'short_desc' => $request->short_desc,
            'description' => $request->description,
            'category' => $request->category,
            'color' => $request->color,
            'sizes' => $request->sizes,
            'price' => $request->price,
            'close_po_date' => $request->close_po_date,
            'status' => $request->status ?? 1,
            'image' => $filename
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
