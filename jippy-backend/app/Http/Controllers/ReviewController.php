<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        
        $formattedReviews = $reviews->map(function($review) {
            return [
                'id' => $review->id,
                'username' => $review->username,
                'rating' => $review->rating,
                'summary' => $review->summary,
                'texture' => $review->texture,
                'expired' => $review->expired,
                'date' => $review->created_at->format('d/m/Y'), 
                'image_url' => $review->image_path ? asset('storage/' . $review->image_path) : null,
            ];
        });

        return response()->json($formattedReviews);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'summary' => 'required|string|max:100',
            'texture' => 'required|string',
            'expired' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reviews', 'public');
            $validated['image_path'] = $path;
        }

        $review = Review::create($validated);

        return response()->json(['message' => 'Review berhasil disimpan', 'data' => $review], 201);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'summary' => 'required|string|max:100',
            'texture' => 'required|string',
            'expired' => 'required|string',
        ]);
        $review->update($validated);

        return response()->json(['message' => 'Review berhasil diupdate', 'data' => $review], 200);
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review tidak ditemukan'], 404);
        }

        if ($review->image_path) {
            Storage::disk('public')->delete($review->image_path);
        }

        $review->delete();

        return response()->json(['message' => 'Review berhasil dihapus']);
    }
}