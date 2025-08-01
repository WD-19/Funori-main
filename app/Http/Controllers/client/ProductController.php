<?php

namespace App\Http\Controllers\client;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProductController
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        if ($request->ajax()) {
            // Nếu là ajax request thì trả về gợi ý tìm kiếm
            $products = Product::where('name', 'LIKE', "%{$query}%")
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                ->orWhereHas('brand', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                ->with(['images'])
                ->where('status', 'published')
                ->take(5)
                ->get();

            return response()->json($products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => number_format($product->regular_price, 0, ',', '.'),
                    'image' => $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png')
                ];
            }));
        }

        // Nếu là request thường thì trả về trang kết quả tìm kiếm
        $products = Product::where(function ($query) use ($request) {
            $q = $request->input('q');
            $query->where('name', 'LIKE', "%{$q}%")
                ->orWhereHas('category', function ($subQuery) use ($q) {
                    $subQuery->where('name', 'LIKE', "%{$q}%");
                })
                ->orWhereHas('brand', function ($subQuery) use ($q) {
                    $subQuery->where('name', 'LIKE', "%{$q}%");
                });
        })
            ->with(['images', 'category', 'brand', 'reviews'])
            ->where('status', 'published')
            ->paginate(12);

        return view('client.search.index', compact('products', 'query'));
    }

    public function show($slug)
    {
        // Lấy sản phẩm kèm các bảng liên quan: ảnh, biến thể, ảnh biến thể, danh mục
        $product = Product::with([
            'images',
            'thumbnail',
            'variants.image',
            'category',
            'variants.attributeValues.attribute',
        ])->where('slug', $slug)->first();

        if (!$product) {
            // Trả về view 404 nếu không tìm thấy sản phẩm
            return response()->view('client.errors.404', [], 404);
        }

        // Lấy tất cả review của sản phẩm, mới nhất trước, kèm user (nếu có)
        $sort = request()->get('sort', 'newest'); // giá trị mặc định: mới nhất

        $reviews = Review::where('product_id', $product->id)
            ->where(function ($q) {
                $q->where('status', 'approved');
                if (Auth::check()) {
                    $q->orWhere(function ($q2) {
                        $q2->where('status', 'pending')
                            ->where('user_id', Auth::id());
                    });
                }
            })
            ->when($sort === 'oldest', fn($q) => $q->orderBy('created_at', 'asc'))
            ->when($sort !== 'oldest', fn($q) => $q->orderBy('created_at', 'desc'))
            ->with('user')
            ->get();

        return view('client.product.detail', compact('product', 'reviews'));
    }
    
    public function store(Request $request, $productId)
    {
        $userId = Auth::id();

        // Validate đầu vào
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Kiểm tra user đã từng mua sản phẩm này chưa
        $orderItem = OrderItem::where('product_id', $productId)
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->first();

        if (!$orderItem) {
            return back()->with('error', 'Bạn chỉ có thể đánh giá sản phẩm đã mua.');
        }

        // OPTIONAL: Kiểm tra đã đánh giá rồi chưa (1 lần duy nhất)
        $alreadyReviewed = Review::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        // Tạo đánh giá
        Review::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'order_item_id' => $orderItem->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Gửi đánh giá thành công! Đánh giá của bạn sẽ được duyệt sớm.');
    }
}
