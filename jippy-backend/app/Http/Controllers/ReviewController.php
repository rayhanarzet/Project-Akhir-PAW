<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();

        $formatted = $reviews->map(function ($r) {
            return [
                'id'            => $r->id,
                'transaction_id'=> $r->transaction_id,
                'product_id'    => $r->product_id,
                'username'      => $r->username,
                'rating'        => $r->rating,
                'summary'       => $r->summary,
                'texture'       => $r->texture,
                'expired'       => $r->expired,
                'date'          => $r->created_at->format('d/m/Y'),

                'image_path'    => $r->image_path,

                'image_url'     => $r->image_path ? asset('storage/' . $r->image_path) : null,
            ];
        });

        return response()->json($formatted);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|integer',
            'username'       => 'required|string',
            'rating'         => 'required|integer|min:1|max:5',
            'summary'        => 'required|string|max:100',
            'texture'        => 'required|string',
            'expired'        => 'required|string',
            'image'          => 'nullable|image|max:20480',
        ]);

        $transaction = Transaction::find($request->transaction_id);
        if (!$transaction) return response()->json(['error' => 'Transaction not found'], 404);

        $validated['product_id'] = $transaction->product_id;

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('reviews', 'public');
        }

        $review = Review::create($validated);

        return response()->json(['message' => 'Review berhasil ditambah', 'data' => $review]);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review) return response()->json(['error' => 'Review not found'], 404);

        $review->update([
            'rating'  => $request->rating,
            'summary' => $request->summary,
            'texture' => $request->texture,
            'expired' => $request->expired,
        ]);

        return response()->json(['message' => 'Review updated']);
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) return response()->json(['error' => 'Review not found'], 404);

        if ($review->image_path) {
            Storage::disk('public')->delete($review->image_path);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted']);
    }
}
