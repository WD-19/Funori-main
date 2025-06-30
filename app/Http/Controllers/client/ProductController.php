<?php

namespace App\Http\Controllers\client;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController
{
    /**
     * Display the product details.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Lấy sản phẩm kèm các bảng liên quan: ảnh, biến thể, ảnh biến thể, danh mục
        $product = Product::with([
            'images',
            'thumbnail',
            'variants.image',
            'category'
        ])->where('slug', $slug)->first();

        if (!$product) {
            // Trả về view 404 nếu không tìm thấy sản phẩm
            return response()->view('client.errors.404', [], 404);
        }

        // Lấy tất cả review của sản phẩm, mới nhất trước, kèm user (nếu có)
        $sort = request()->get('sort', 'newest'); // giá trị mặc định: mới nhất

        $reviews = Review::where('product_id', $product->id)
            ->where('status', 'approved')
            ->when($sort === 'oldest', fn($q) => $q->orderBy('created_at', 'asc'))
            ->when($sort !== 'oldest', fn($q) => $q->orderBy('created_at', 'desc'))
            ->with('user') // nếu cần user
            ->get();

        return view('client.product.detail', compact('product', 'reviews'));
    }

    public function store(Request $request, $productId)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        // Validate đầu vào
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Kiểm tra user đã từng mua sản phẩm này chưa
        $orderItem = \App\Models\OrderItem::where('product_id', $productId)
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->first();

        if (!$orderItem) {
            return back()->with('error', 'Bạn chỉ có thể đánh giá sản phẩm đã mua.');
        }

        // OPTIONAL: Kiểm tra đã đánh giá rồi chưa (1 lần duy nhất)
        $alreadyReviewed = \App\Models\Review::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        // Tạo đánh giá
        \App\Models\Review::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'order_item_id' => $orderItem->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Gửi đánh giá thành công! Đánh giá của bạn sẽ được duyệt sớm.');
    }

    public function search(Request $request)
    {
        $query = Product::query();

        // Nếu có keyword thì tìm theo tên hoặc mô tả
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        // Sắp xếp theo ngày tạo mới nhất
        $query->orderBy('created_at', 'desc');

        // Lấy kết quả phân trang
        $products = $query->paginate(12)->appends($request->all());

        return view('client.product.search', compact('products'));
    }
}
