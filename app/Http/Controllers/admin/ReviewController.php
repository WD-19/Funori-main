<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;

class ReviewController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Review::with(['product', 'user', 'orderItem']);

        // Tìm kiếm theo tên user hoặc tên sản phẩm
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('user', function ($q2) use ($keyword) {
                    $q2->where('full_name', 'like', "%$keyword%");
                })->orWhereHas('product', function ($q2) use ($keyword) {
                    $q2->where('name', 'like', "%$keyword%");
                });
            });
        }

        // Lọc theo status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reviews = $query->paginate(10)->appends($request->all());
        $orders = Order::all(['id', 'order_code']);
        return view('admin.reviews.index', compact('reviews', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::with(['user', 'product', 'orderItem'])->findOrFail($id);
        $orders = Order::all(['id', 'order_code']);
        return view('admin.reviews.edit', compact('review', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $review = Review::findOrFail($id);
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->status = $request->status;
        $review->save();

        return redirect()->route('admin.reviews.index')->with('success', 'Cập nhật đánh giá thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reviews = Review::findOrFail($id);
        $reviews->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Xóa đánh giá thành công!');
    }

    public function export()
    {
        $reviews = Review::with(['user', 'product', 'orderItem'])->get();

        $filename = 'reviews_' . date('Ymd_His') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'ID',
            'User',
            'Product',
            'Order Item',
            'Rating',
            'Comment',
            'Status',
            'Created At'
        ];

        $callback = function () use ($reviews, $columns) {
            if (ob_get_level() > 0) {
                ob_end_clean();
            }
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($reviews as $review) {
                fputcsv($file, [
                    $review->id,
                    $review->user->full_name ?? '',
                    $review->product->name ?? '',
                    $review->orderItem->id ?? '',
                    $review->rating,
                    $review->comment,
                    $review->status,
                    $review->created_at,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    function trash()
    {
        $reviews = Review::onlyTrashed()->paginate(10);
        return view('admin.reviews.trash', compact('reviews'));
    }

    public function restore($id)
    {
        $contact = Review::onlyTrashed()->findOrFail($id);
        $contact->restore();
        return redirect()->route('admin.reviews.trash')->with('success', 'Khôi phục đánh giá thành công!');
    }

    public function forceDelete($id)
    {
        $contact = Review::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();
        return redirect()->route('admin.reviews.trash')->with('success', 'Xóa vĩnh viễn đánh giá thành công!');
    }
}
