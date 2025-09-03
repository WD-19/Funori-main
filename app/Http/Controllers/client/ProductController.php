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

        $badWords = [
            // Tiếng Việt
            'địt', 'cặc', 'lồn', 'đéo', 'dm', 'đmm', 'đm', 'dcm', 'dmm', 'djt', 'djtme', 'djt mẹ', 'djt mày', 'đjt', 'đjt mẹ', 'đjt mày',
            'ngu', 'bố mày', 'mẹ mày', 'bố mày mày', 'mẹ mày mày', 'bố mày đấy', 'mẹ mày đấy',
            'chó', 'chó má', 'mẹ kiếp', 'vãi', 'vkl', 'vcl', 'vãi l', 'vãi c', 'vãi cả l', 'vãi cả c',
            'khốn nạn', 'khốn', 'khốn kiếp', 'bẩn thỉu', 'bẩn', 'bựa', 'bựa vãi', 'bựa vl',
            'thằng ngu', 'con ngu', 'thằng chó', 'con chó', 'thằng khốn', 'con khốn', 'thằng điên', 'con điên',
            'thằng rồ', 'con rồ', 'thằng dở', 'con dở', 'thằng hâm', 'con hâm',
            'mẹ cha', 'mẹ cha mày', 'bà nội mày', 'ông nội mày', 'bà ngoại mày', 'ông ngoại mày',
            'mẹ nó', 'bố nó', 'bố láo', 'láo toét', 'láo', 'láo nháo',
            'đồ ngu', 'đồ chó', 'đồ khốn', 'đồ điên', 'đồ rồ', 'đồ dở', 'đồ hâm',
            // Tiếng Anh
            'fuck', 'shit', 'bitch', 'asshole', 'f*ck', 'suck', 'pussy', 'dick', 'bastard', 'slut', 'whore', 'jerk', 'moron', 'retard', 'loser',
            'fucking', 'motherfucker', 'son of a bitch', 'douche', 'douchebag', 'cunt', 'prick', 'cock', 'arsehole', 'bollocks', 'bugger', 'wanker',
            'damn', 'bloody', 'crap', 'arse', 'twat', 'twit', 'git', 'shithead', 'shitface', 'shitbag', 'shitass', 'shitty',
            // Biến thể viết tắt, lách luật
            'fuk', 'fukc', 'sh!t', 'b!tch', 'b1tch', 'b!tch', 'p*ssy', 'd!ck', 'd1ck', 'c0ck', 'c*ck', 's0n of a b!tch', 'wtf', 'wth', 'fml', 'omfg',
            // Ký tự đặc biệt, biến thể unicode
            'đ*o', 'đ.m', 'đ.mẹ', 'đ.mày', 'đ.mẹ mày', 'đ.mày mẹ', 'đ.mẹ mày', 'đ.mày mẹ',
        ];
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
            ->get()
            ->filter(function($review) use ($badWords) {
                foreach ($badWords as $word) {
                    if (stripos($review->comment, $word) !== false) {
                        return false;
                    }
                }
                return true;
            });

        return view('client.product.detail', compact('product', 'reviews'));
    }
    
    public function store(Request $request, $productId)
    {
        // Danh sách từ cấm (đồng bộ với hàm show)
        $badWords = [
            'địt', 'cặc', 'lồn', 'đéo', 'dm', 'đmm', 'đm', 'dcm', 'dmm', 'djt', 'djtme', 'djt mẹ', 'djt mày', 'đjt', 'đjt mẹ', 'đjt mày',
            'ngu', 'bố mày', 'mẹ mày', 'bố mày mày', 'mẹ mày mày', 'bố mày đấy', 'mẹ mày đấy',
            'chó', 'chó má', 'mẹ kiếp', 'vãi', 'vkl', 'vcl', 'vãi l', 'vãi c', 'vãi cả l', 'vãi cả c',
            'khốn nạn', 'khốn', 'khốn kiếp', 'bẩn thỉu', 'bẩn', 'bựa', 'bựa vãi', 'bựa vl',
            'thằng ngu', 'con ngu', 'thằng chó', 'con chó', 'thằng khốn', 'con khốn', 'thằng điên', 'con điên',
            'thằng rồ', 'con rồ', 'thằng dở', 'con dở', 'thằng hâm', 'con hâm',
            'mẹ cha', 'mẹ cha mày', 'bà nội mày', 'ông nội mày', 'bà ngoại mày', 'ông ngoại mày',
            'mẹ nó', 'bố nó', 'bố láo', 'láo toét', 'láo', 'láo nháo',
            'đồ ngu', 'đồ chó', 'đồ khốn', 'đồ điên', 'đồ rồ', 'đồ dở', 'đồ hâm',
            'fuck', 'shit', 'bitch', 'asshole', 'f*ck', 'suck', 'pussy', 'dick', 'bastard', 'slut', 'whore', 'jerk', 'moron', 'retard', 'loser',
            'fucking', 'motherfucker', 'son of a bitch', 'douche', 'douchebag', 'cunt', 'prick', 'cock', 'arsehole', 'bollocks', 'bugger', 'wanker',
            'damn', 'bloody', 'crap', 'arse', 'twat', 'twit', 'git', 'shithead', 'shitface', 'shitbag', 'shitass', 'shitty',
            'fuk', 'fukc', 'sh!t', 'b!tch', 'b1tch', 'b!tch', 'p*ssy', 'd!ck', 'd1ck', 'c0ck', 'c*ck', 's0n of a b!tch', 'wtf', 'wth', 'fml', 'omfg',
            'đ*o', 'đ.m', 'đ.mẹ', 'đ.mày', 'đ.mẹ mày', 'đ.mày mẹ', 'đ.mẹ mày', 'đ.mày mẹ',
            // Thêm các biến thể tiếng Việt
            'cl', 'đkmm', 'đkm', 'đcmm', 'đcm', 'cmn', 'cmnl', 'cmm', 'cm', 'c.m', 'đcmnl', 'đkmn', 'đmcn', 'đmct', 
            'vl', 'vloz', 'vlon', 'vlol', 'v.l', 'dkm', 'đb', 'dkmm', 'đbrr', 'đbrđ', 'đậu má', 'đậu mẹ', 
            'mịe', 'mịa', 'mie', 'mja', 'mjk', 'mik', 'cmnđ', 'cđ', 'cđm', 'cmđ', 'vc', 'vồn', 'vôn', 'đkl',
            'buồi', 'buoi', 'bu0i', 'bư0i', 'bư.0i', 'cu', 'cứt', 'cut', 'c.ứ.t', 'c_ứ_t', 'c*t', 'c.u.t', 'cut', 'c ứ t', 'c-ứ-t', 
            'cức', 'cưc', 'cuc', 'cưt', 'cuwt', 'chịch', 'chjch', 'hentai', 'đấm', 'dám', 'đái', 'dai', 'đ.á.i',
            // Các từ ngữ khiêu dâm
            'sex', 'sexy', 'porn', 'p0rn', 'pr0n', 'phim sex', 'phim người lớn', 'xxx', 'xxxxx', 'xxxx', 'x.x.x', 'xx',
            'khiêu dâm', 'khieu dam', 'kh13u d4m', 'khi3u dam', 'kh1eu d@m', 'dâm', 'dê', 'dâm dê', 'dâm đãng', 'dam dang',
            // Thêm biến thể tiếng Anh
            'f u c k', 'f.u.c.k', 'f-u-c-k', 'fvck', 'phuck', 'phuk', 'ph*ck', 'f**k', 'f**king', 'fcuk', 'fcking',
            'sh1t', 'sh!t', 's.h.i.t', 's h i t', 's-h-i-t', 'bull****', 'bullsh*t', 'bs', 'b.s', 'bullsht',
            'stfu', 'gtfo', 'stf', 'gtf', 'foad', 'lmfao', 'lmao', 'rofl', 'ffs', 'milf', 'gilf', 'dilf',
            'a$$', 'a$$hole', '@$$', '@$$hole', 'a**', 'a**hole', '@**', '@**hole', 'a-hole', '@-hole',
            'scumbag', 'dumbass', 'dumb@ss', 'dumb@$$', 'dumba$$', 'dumb a**', 'dumba**', 'jackass',
            'b*tch', 'b*tches', 'b!tches', 'b1tches', 'b17ch', 'b17ches', 'b*tchy', 'btch', 'beaches',
            // Các từ cố tình viết sai để tránh kiểm duyệt
            'd1t', 'd!t', 'd!tm', 'd1tm', 'd.!.t', 'd.1.t', 'd_i_t', 'dlt', 'd1tm3', 'd!tm3', 'd!t m3',
            'l0n', 'l0`n', 'l0^n', 'l`ôn', 'l.0.n', 'l_0_n', 'c@c', 'c4c', 'c.a.c', 'c_a_c', 'c@.c',
            // Các từ công kích, phân biệt đối xử
            'óc chó', 'não lợn', 'não tôm', 'não cá vàng', 'ăn bám', 'ăn hại', 'phế phẩm', 'vô dụng',
            'mất dạy', 'vô học', 'thô bỉ', 'thô lỗ', 'mất nết', 'vô văn hóa', 'đê tiện', 'hèn hạ',
            'tồi tệ', 'lừa đảo', 'lưu manh', 'đểu cáng', 'đểu giả', 'giả dối', 'dối trá',
            'gay', 'lesbian', 'bê đê', 'pêđê', 'les', 'bóng', 'lbgt', 'lgbt', 'bede', 'béđê', 'bede',
            // Tục tĩu khác
            'zú', 'ngực', 'mông', 'đít', 'vú', 'khe', 'kh3', 'cu', 'chym', 'ch1m', 'dz1t',
            // Các từ liên quan đến chất thải
            'unchi', 'ỉa', 'ia', 'đi ỉa', 'đi ia', 'đi nặng', 'phân', 'ph4n', 'phaan', 'ph@n', 'ph.a.n',
            'cứt đái', 'cứt đéo', 'cứt chó', 'đồ cứt', 'như cứt', 'cứt đ', 'cứt mẹ', 'cứt con',
            'ỉ chảy', 'i chay', 'bỉ ổi', 'bi oi', 'tanh hôi', 'dơ dáy', 'do day', 'thối tha', 'thoi tha',
            'tè', 'te', 'đái dầm', 'dai dam', 'đái són', 'dai son', 'tè bậy', 'te bay'
        ];

        // Nếu comment có bad word thì trả về thông báo riêng
        $comment = $request->comment;
        if ($comment) {
            foreach ($badWords as $word) {
                if (stripos($comment, $word) !== false) {
                    return back()->with('error', 'Nội dung đánh giá của bạn chứa từ ngữ không phù hợp. Vui lòng chỉnh sửa lại!')->with('toastr_error', 'Nội dung đánh giá của bạn chứa từ ngữ không phù hợp.');
                }
            }
        }
    
        $userId = Auth::id();

        // Validate đầu vào
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ], [
            'rating.required' => 'Vui lòng chọn số sao đánh giá.',
            'rating.integer' => 'Số sao phải là số nguyên.',
            'rating.min' => 'Số sao tối thiểu là 1.',
            'rating.max' => 'Số sao tối đa là 5.',
            'comment.max' => 'Nội dung đánh giá không được quá 1000 ký tự.',
        ]);

        // Kiểm tra user đã từng mua sản phẩm này chưa (chỉ đơn hàng đã giao thành công)
        $orderItems = OrderItem::where('product_id', $productId)
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('order_status', 'delivered');
            })
            ->get();

        if ($orderItems->isEmpty()) {
            return back()->with('error', 'Bạn chỉ có thể đánh giá sản phẩm đã mua.')->with('toastr_error', 'Bạn chỉ có thể đánh giá sản phẩm đã mua.');
        }

        // Kiểm tra số lần đã đánh giá
        $existingReviews = Review::where('user_id', $userId)
            ->where('product_id', $productId)
            ->count();

        // Nếu đã đánh giá nhiều lần hơn số lần mua, hiển thị thông báo
        if ($existingReviews >= $orderItems->count()) {
            return back()->with('error', 'Bạn đã đánh giá đủ số lần cho sản phẩm này. Vui lòng mua thêm sản phẩm để có thể đánh giá lại.')->with('toastr_warning', 'Bạn đã đánh giá đủ số lần cho sản phẩm này. Vui lòng mua thêm sản phẩm để có thể đánh giá lại.');
        }

        // Kiểm tra xem có đang đánh giá cùng lúc không (trong vòng 30 giây)
        $recentReview = Review::where('user_id', $userId)
            ->where('product_id', $productId)
            ->where('created_at', '>=', now()->subSeconds(30))
            ->first();

        if ($recentReview) {
            return back()->with('error', 'Bạn vừa đánh giá sản phẩm này. Vui lòng đợi một chút trước khi đánh giá lại.')->with('toastr_warning', 'Bạn vừa đánh giá sản phẩm này. Vui lòng đợi một chút trước khi đánh giá lại.');
        }
      
        // Lấy order item chưa được đánh giá
        $unreviewedOrderItem = $orderItems->first(function ($item) use ($userId, $productId) {
            return !Review::where('user_id', $userId)
                ->where('product_id', $productId)
                ->where('order_item_id', $item->id)
                ->exists();
        });

        if (!$unreviewedOrderItem) {
            return back()->with('error', 'Tất cả đơn hàng của bạn đã được đánh giá.')->with('toastr_warning', 'Tất cả đơn hàng của bạn đã được đánh giá.');
        }

        Review::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'order_item_id' => $unreviewedOrderItem->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'approved',
        ]);

        return back()->with('success', 'Gửi đánh giá thành công! Đánh giá của bạn sẽ được duyệt sớm.')->with('toastr_success', 'Gửi đánh giá thành công! Đánh giá của bạn sẽ được duyệt sớm.');
    }
}
