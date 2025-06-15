<?php

namespace App\Http\Controllers\API\admin;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Review::query();

        if ($request->has('trashed') && $request->trashed) {
            $query = $query->onlyTrashed();
        }

        $reviews = $query->orderByDesc('id')->paginate(10);

        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'order_item_id'  => 'required|exists:order_items,id',
            'rating'     => 'required|numeric|min:1|max:5',
            'comment'    => 'nullable|string',
            'status'     => 'nullable|string',
        ]);

        $review = Review::create($data);

        return response()->json([
            'message' => 'Tạo đánh giá thành công!',
            'review'  => $review,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $review = Review::withTrashed()->findOrFail($id);
        return response()->json($review);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $review = Review::withTrashed()->findOrFail($id);

        $data = $request->validate([
            'rating'  => 'sometimes|numeric|min:1|max:5',
            'comment' => 'nullable|string',
            'status'  => 'nullable|string',
        ]);

        $review->update($data);

        return response()->json([
            'message' => 'Cập nhật đánh giá thành công!',
            'review'  => $review,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json([
            'message' => 'Đã xóa mềm đánh giá!',
        ]);
    }

    // Khôi phục đánh giá đã xóa mềm
    public function restore($id)
    {
        $review = Review::onlyTrashed()->findOrFail($id);
        $review->restore();

        return response()->json([
            'message' => 'Khôi phục đánh giá thành công!',
            'review'  => $review,
        ]);
    }

    // Xóa vĩnh viễn đánh giá
    public function forceDelete($id)
    {
        $review = Review::onlyTrashed()->findOrFail($id);
        $review->forceDelete();

        return response()->json([
            'message' => 'Đã xóa vĩnh viễn đánh giá!',
        ]);
    }
}
