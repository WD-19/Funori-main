<?php

namespace App\Http\Controllers\client;

use App\Models\Cart;
use Illuminate\Support\Facades\Log;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Promotion;
use Illuminate\Support\Collection;

class CartController
{
    public function cart(Request $request)
    {
        $cartItems = [];
        $total = 0;
        $cartCount = 0;
        $removedItems = [];

        Log::info('Loading cart page. Initial cartItems:', ['cartItems' => $cartItems]);

        if (Auth::check()) {
            // Lấy giỏ hàng từ database cho user đã đăng nhập
            $cart = Cart::where('user_id', Auth::id())->first();

            if ($cart) {
                $cartItemsRaw = CartItem::with([
                    'product.images',
                    'product.variants',
                    'productVariant.image',
                    'productVariant.attributeValues.attribute'
                ])->where('cart_id', $cart->id)->get();

                // Kiểm tra và xóa sản phẩm không hợp lệ
                foreach ($cartItemsRaw as $item) {
                    $product = $item->product;
                    
                    // Kiểm tra sản phẩm tồn tại và có trạng thái hợp lệ
                    if (!$product || ($product->status !== 'active' && $product->status !== 'published')) {
                        // Lưu tên sản phẩm đã bị xóa để thông báo
                        $removedItems[] = $product ? $product->name : 'Sản phẩm không xác định';
                        
                        // Xóa sản phẩm khỏi giỏ hàng
                        $item->delete();
                        continue;
                    }
                    
                    // Kiểm tra số lượng tồn kho
                    $variant = $item->productVariant;
                    $inStock = true;
                    
                    if ($variant) {
                        if ($variant->stock_quantity < $item->quantity) {
                            $inStock = false;
                        }
                    } else {
                        if ($product->stock_quantity < $item->quantity) {
                            $inStock = false;
                        }
                    }
                    
                    if (!$inStock) {
                        $removedItems[] = $product->name . ' (Hết hàng)';
                        $item->delete();
                        continue;
                    }
                    
                    $variant = $item->productVariant;

                    $imageUrl = null;
                    $variantImage = null;
                    if ($variant && $variant->image && $variant->image->image_url) {
                        $variantImage = $variant->image->image_url;
                    }

                    if ($variantImage) {
                        $imageUrl = $variantImage;
                    } elseif ($product && $product->images && $product->images->first()) {
                        $imageUrl = $product->images->first()->image_url;
                    } else {
                        $imageUrl = 'images/products/no-image.png';
                    }

                    $variantAttributes = $variant && $variant->attributeValues
                        ? $variant->attributeValues->map(function ($v) {
                            return (optional($v->attribute)->name ?? '') . ': ' . ($v->value ?? '');
                        })->filter()->toArray()
                        : [];

                    $cartItems[] = [
                        'id' => $item->product_id . '_' . ($item->product_variant_id ?? 'null'),
                        'product_id' => $product->id,
                        'product_variant_id' => $variant->id ?? null,
                        'quantity' => $item->quantity,
                        'price_at_addition' => $item->price_at_addition,
                        'image_url' => $imageUrl,
                        'product' => $product->toArray(),
                        'variant_attributes' => $variantAttributes,
                        'variant' => $variant ? $variant->toArray() : null,
                    ];
                }
            }
        } else {
            // Guest cart from session
            $sessionCart = Session::get('cart', []);
            $updatedSessionCart = [];

            foreach ($sessionCart as $item) {
                // Sửa lỗi: Lấy giá trực tiếp từ session, không tính toán lại
                // để đảm bảo nhất quán với giá lúc thêm vào.
                if (isset($item['product_id'])) {
                    $product = Product::with([
                        'images',
                        'variants.image',
                        'variants.attributeValues.attribute'
                    ])->find($item['product_id']);
                } else {
                    continue; // Bỏ qua item không hợp lệ
                }
                
                // Kiểm tra sản phẩm tồn tại và có trạng thái hợp lệ
                if (!$product || ($product->status !== 'active' && $product->status !== 'published')) {
                    // Lưu tên sản phẩm đã bị xóa để thông báo
                    $productName = isset($item['product']['name']) ? $item['product']['name'] : 
                                  ($product ? $product->name : 'Sản phẩm không xác định');
                    $removedItems[] = $productName;
                    continue;
                }
                
                // Kiểm tra số lượng tồn kho
                $inStock = true;
                
                if (!empty($item['product_variant_id'])) {
                    $variant = ProductVariant::find($item['product_variant_id']);
                    if (!$variant || $variant->stock_quantity < $item['quantity']) {
                        $inStock = false;
                    }
                } else {
                    if ($product->stock_quantity < $item['quantity']) {
                        $inStock = false;
                    }
                }
                
                if (!$inStock) {
                    $productName = isset($item['product']['name']) ? $item['product']['name'] : $product->name;
                    $removedItems[] = $productName . ' (Hết hàng)';
                    continue;
                }
                
                // Sản phẩm hợp lệ, thêm vào giỏ hàng cập nhật
                $updatedSessionCart[] = $item;

                // Lấy thông tin biến thể nếu có
                $variant = !empty($item['product_variant_id'])
                    ? ProductVariant::with(['image', 'attributeValues.attribute'])->find($item['product_variant_id'])
                    : null;

                // Xử lý hình ảnh và thuộc tính
                $variantImage = optional($variant->image)->image_url;
                $productImage = optional($product->images->first())->image_url;
                $imageUrl = $variantImage ?? $productImage ?? asset('images/products/no-image.png');

                $variantAttributes = $variant && $variant->attributeValues
                    ? $variant->attributeValues->map(function ($attrVal) {
                        return (optional($attrVal->attribute)->name ?? '') . ': ' . ($attrVal->value ?? '');
                    })->filter()->toArray()
                    : [];

                $cartItems[] = [
                    'id' => $item['product_id'] . '_' . ($item['product_variant_id'] ?? 'null'),
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity' => $item['quantity'],
                    'price_at_addition' => $item['price_at_addition'], // Lấy giá đã lưu
                    'image_url' => $imageUrl,
                    'product' => $product ? $product->toArray() : null,
                    'variant_attributes' => $variantAttributes,
                    'variant' => $variant ? $variant->toArray() : null,
                ];
            }
            
            // Cập nhật lại session cart sau khi lọc
            Session::put('cart.items', $updatedSessionCart);
        }

        $total = array_sum(array_map(fn($item) => $item['quantity'] * $item['price_at_addition'], $cartItems));
        $cartCount = count($cartItems);

        // Đảm bảo dữ liệu giỏ hàng được lưu vào session['cart'] để checkout lấy được
        Session::put('cart.items', $cartItems);
        Session::put('cart.total', $total);
        
        // Xóa voucher nếu quay về từ trang checkout (để tránh tính sai số lần sử dụng)
        if (Session::has('checkout')) {
            Session::forget('cart.discount');
            Session::forget('cart.discount_code');
            Session::forget('cart.promotion_id');
        } else {
            Session::put('cart.discount', Session::get('cart.discount', 0)); // Giữ nguyên nếu có
        }
        // Có thể thêm các giá trị khác nếu cần (discount, shipping_fee...)

        // Chuyển đổi cartItems thành format phù hợp cho view
        $cartItems = collect($cartItems)->mapWithKeys(function ($item) {
            $key = $item['product_id'] . '_' . ($item['product_variant_id'] ?? 'null');
            return [$key => $item];
        })->toArray();

        // Lấy sản phẩm mới nhất để gợi ý
        $newestProducts = Product::with(['images', 'reviews', 'variants'])
            ->orderByDesc('created_at')
            ->take(8)
            ->get();

        // Phân loại sản phẩm bị xóa để hiển thị thông báo chi tiết
        $discontinuedItems = [];
        $outOfStockItems = [];
        $errorMessages = [];
        
        foreach ($removedItems as $item) {
            // Phân biệt lý do xóa nếu có thông tin
            if (strpos($item, '(Hết hàng)') !== false) {
                $outOfStockItems[] = str_replace(' (Hết hàng)', '', $item);
            } else {
                $discontinuedItems[] = $item;
            }
        }
        
        // Hiển thị thông báo phân loại theo lý do
        if (!empty($discontinuedItems)) {
            $message = count($discontinuedItems) > 1 
                ? "Các sản phẩm: " . implode(", ", $discontinuedItems) . " đã được xóa khỏi giỏ hàng do ngừng kinh doanh." 
                : "Sản phẩm " . $discontinuedItems[0] . " đã được xóa khỏi giỏ hàng do ngừng kinh doanh.";
            
            Session::flash('error_discontinued', $message);
            $errorMessages['discontinued'] = $message;
        }
        
        if (!empty($outOfStockItems)) {
            $message = count($outOfStockItems) > 1 
                ? "Các sản phẩm: " . implode(", ", $outOfStockItems) . " đã được xóa khỏi giỏ hàng do hết hàng." 
                : "Sản phẩm " . $outOfStockItems[0] . " đã được xóa khỏi giỏ hàng do hết hàng.";
            
            Session::flash('error_outofstock', $message);
            $errorMessages['outofstock'] = $message;
        }

        return view('client.cart.cart', compact('cartItems', 'total', 'cartCount', 'newestProducts', 'errorMessages'));
    }
    
      public function applyDiscount(Request $request)
    {
        $request->validate([
            'discount_code' => 'required|string',
          'selected_items' => 'required|array',
          'selected_items.*.item_id' => 'required|string',
        ]);
    
        $discountCode = $request->discount_code;
        $selectedItemsData = $request->selected_items;

        // Tính tổng tiền của các sản phẩm được chọn từ trạng thái giỏ hàng ở server
        $selectedIds = array_map(function ($it) { return $it['item_id']; }, $selectedItemsData);
        $total = 0;
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $selectedItems = $cart->items->filter(function ($it) use ($selectedIds) {
                    $key = $it->product_id . '_' . ($it->product_variant_id ?? 'null');
                    return in_array($key, $selectedIds);
                });
                $total = $selectedItems->sum(fn($it) => $it->quantity * $it->price_at_addition);
            }
        } else {
            $sessionCart = Session::get('cart', []);
            $selectedItems = collect($sessionCart)->filter(function ($it, $key) use ($selectedIds) {
                return in_array($key, $selectedIds);
            });
            $total = $selectedItems->sum(fn($it) => $it['quantity'] * ($it['price_at_addition'] ?? ($it['price'] ?? 0)));
        }

        // Tìm khuyến mãi hợp lệ
        $promotion = Promotion::where('code', $discountCode)
            ->where('is_active', 1)
            ->where(function ($query) {
                $query->whereNull('start_date')
                      ->orWhere('start_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
            })
            ->first();
    
        if (!$promotion) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn!'], 400);
        }
    
        // Kiểm tra điều kiện áp dụng (nếu có)
        if ($promotion->min_order_value && $total < $promotion->min_order_value) {
            return response()->json(['success' => false, 'message' => "Giá trị đơn hàng tối thiểu để áp dụng mã là " . number_format((float) $promotion->min_order_value, 0, ',', '.') . "đ"], 400);
        }
    
        // Tính giá trị giảm
        $discountAmount = 0;
    
        if ($promotion->discount_type == 'percentage') {
            $discountAmount = ($total * $promotion->discount_value) / 100;
            if ($promotion->max_discount_amount && $discountAmount > $promotion->max_discount_amount) {
                $discountAmount = $promotion->max_discount_amount;
            }
        } elseif ($promotion->discount_type == 'fixed_amount') {
            $discountAmount = $promotion->discount_value;
        }
    
        // Kiểm tra giới hạn sử dụng tổng cộng (nếu có)
        if ($promotion->usage_limit_per_voucher !== null) {
            if ($promotion->times_used >= $promotion->usage_limit_per_voucher) {
                return response()->json(['success' => false, 'message' => 'Mã giảm giá đã hết lượt sử dụng!'], 400);
            }
        }
    
        // Kiểm tra giới hạn sử dụng cho mỗi user (nếu user đã đăng nhập và có giới hạn)
        if (Auth::check() && $promotion->usage_limit_per_user !== null) {
            // Chỉ đếm đơn hàng thành công, không đếm đơn hàng đã hủy/thất bại/đang chờ
            $userUsedCount = Order::where('user_id', Auth::id())
                ->where('discount_code', $discountCode)
                ->whereNotIn('order_status', ['cancelled', 'failed', 'pending'])
                ->count();
            if ($userUsedCount >= $promotion->usage_limit_per_user) {
                return response()->json(['success' => false, 'message' => 'Bạn đã sử dụng mã giảm giá này rồi!'], 400);
            }
        }
    
    // Lưu thông tin khuyến mãi vào session
    // Lưu ý: discountAmount ở đây là cho các sản phẩm được chọn, không phải toàn bộ giỏ hàng
        Session::put('cart.discount', $discountAmount);
        Session::put('cart.discount_code', $discountCode); // Lưu mã code để kiểm tra sau này
        
        // Lưu thông tin promotion để sử dụng sau này
    Session::put('cart.promotion_id', $promotion->id);
    // Lưu danh sách item_id mà người dùng đã chọn để áp mã (dạng productId_variantId)
    Session::put('cart.discount_selected_items', $selectedIds);
    
    return response()->json([
            'success' => true,
            'message' => 'Mã giảm giá đã được áp dụng!',
            'discount' => (int) $discountAmount,
            'new_total' => $total - $discountAmount
        ]);
    }


    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'product_variant_id' => 'nullable|exists:product_variants,id'
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $productVariantId = $request->product_variant_id;

        // Tính giá và tồn kho
        $price = $product->regular_price;
        $stockQuantity = $product->stock_quantity;

        $variant = null;
        if ($productVariantId) {
            $variant = ProductVariant::with(['image', 'attributeValues.attribute'])->find($productVariantId);
            $stockQuantity = $variant ? $variant->stock_quantity : 0;
            if ($variant && $variant->price_modifier !== null) {
                $price += $variant->price_modifier;
            }
        }

        if (Auth::check()) {
            // User đã đăng nhập - lưu vào database
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $cartItem = $cart->items()->where([
                'product_id' => $product->id,
                'product_variant_id' => $productVariantId
            ])->first();

            $currentCartQty = $cartItem ? $cartItem->quantity : 0;
            if ($quantity + $currentCartQty > $stockQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng vượt quá tồn kho hiện có!'
                ], 400);
            }

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Sản phẩm đã có trong giỏ hàng, đã tăng số lượng.',
                    'cart_count' => $cart->items()->count(),
                    'already_exists' => true
                ]);
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'product_variant_id' => $productVariantId,
                    'quantity' => $quantity,
                    'price_at_addition' => $price
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
                    'cart_count' => $cart->items()->count(),
                    'already_exists' => false
                ]);
            }
        } else {
            // Guest - vẫn dùng session
            $cart = Session::get('cart', []);
            $key = $product->id . '_' . ($productVariantId ?? 'null');
            $currentCartQty = isset($cart[$key]) ? $cart[$key]['quantity'] : 0;

            if ($quantity + $currentCartQty > $stockQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng vượt quá tồn kho hiện có!'
                ], 400);
            }

            $isNewItem = !isset($cart[$key]);
            
            if (isset($cart[$key])) {
                // Nếu sản phẩm đã có trong giỏ hàng, cộng dồn số lượng
                $cart[$key]['quantity'] += $quantity;
            } else {
                // Nếu sản phẩm chưa có, tạo mới
                $cart[$key] = [
                    'product_id' => $product->id,
                    'product_variant_id' => $productVariantId,
                    'quantity' => $quantity,
                    'price_at_addition' => $price
                ];
            }

            Session::put('cart', $cart);
            return response()->json([
                'success' => true,
                'message' => $isNewItem ? 'Sản phẩm đã được thêm vào giỏ hàng' : 'Sản phẩm đã có trong giỏ hàng, đã tăng số lượng.',
                'cart_count' => count($cart),
                'already_exists' => !$isNewItem
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'quantity' => 'nullable|integer|min:1'
        ]);

        // Nếu user đã đăng nhập
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                // item_id dạng: productId_variantId (VD: 12_5 hoặc 12_null)
                $parts = explode('_', $request->item_id);
                $productId = $parts[0] ?? null;
                $variantId = $parts[1] ?? null;
                $variantId = $variantId === 'null' ? null : $variantId;

                if (!$productId) {
                    return response()->json([
                        'success' => false,
                        'message' => 'ID sản phẩm không hợp lệ!'
                    ], 400);
                }

                $cartItem = $cart->items()->where([
                    'product_id' => $productId,
                    'product_variant_id' => $variantId
                ])->first();

                if ($cartItem) {
                    // Nếu có truyền quantity thì cập nhật
                    if ($request->has('quantity')) {
                        // Kiểm tra tồn kho
                        $stockQuantity = 0;
                        if ($cartItem->product_variant_id) {
                            $variant = ProductVariant::find($cartItem->product_variant_id);
                            $stockQuantity = $variant ? $variant->stock_quantity : 0;
                        } else {
                            $product = Product::find($productId);
                            $stockQuantity = $product ? $product->stock_quantity : 0;
                        }
                        if ($request->quantity > $stockQuantity) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Số lượng vượt quá tồn kho hiện có!'
                            ], 400);
                        }
                        $cartItem->quantity = $request->quantity;
                    }
                    $cartItem->save(); // Lưu vào database

                    // Tính lại tổng tiền giỏ hàng
                    $total = $cart->items->sum(fn($item) => $item->quantity * $item->price_at_addition);

                    // Recalc discount theo danh sách sản phẩm đã chọn (nếu có)
                    $discountAmount = 0;
                    $promotionId = Session::get('cart.promotion_id');
                    $selectedIds = Session::get('cart.discount_selected_items', []);
                    if ($promotionId && !empty($selectedIds)) {
                        $promotion = Promotion::find($promotionId);
                        if ($promotion) {
                            $selectedItems = $cart->items->filter(function ($it) use ($selectedIds) {
                                $key = $it->product_id . '_' . ($it->product_variant_id ?? 'null');
                                return in_array($key, $selectedIds);
                            });
                            $selectedTotal = $selectedItems->sum(fn($it) => $it->quantity * $it->price_at_addition);
                            if ($promotion->min_order_value && $selectedTotal < $promotion->min_order_value) {
                                Session::forget('cart.discount');
                                Session::forget('cart.discount_code');
                                Session::forget('cart.promotion_id');
                                Session::forget('cart.discount_selected_items');
                                $discountAmount = 0;
                            } else {
                                if ($promotion->discount_type === 'percentage') {
                                    $discountAmount = ($selectedTotal * $promotion->discount_value) / 100;
                                    if ($promotion->max_discount_amount && $discountAmount > $promotion->max_discount_amount) {
                                        $discountAmount = $promotion->max_discount_amount;
                                    }
                                } elseif ($promotion->discount_type === 'fixed_amount') {
                                    $discountAmount = $promotion->discount_value;
                                }
                                Session::put('cart.discount', $discountAmount);
                            }
                        }
                    }

                    return response()->json([
                        'success' => true,
                        'item_total' => $cartItem->quantity * $cartItem->price_at_addition,
                        'item_price' => $cartItem->price_at_addition,
                        'subtotal' => $total,
                        'discount' => (int) ($discountAmount ?? 0)
                    ]);
                }
            }
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!'
            ], 404);
        } else {
            // Nếu là khách (chưa đăng nhập) thì lưu vào session
            $cart = Session::get('cart', []);
            if (isset($cart[$request->item_id])) {
                $parts = explode('_', $request->item_id);
                $productId = $parts[0] ?? null;
                $variantId = $parts[1] ?? null;
                $variantId = $variantId === 'null' ? null : $variantId;

                if (!$productId) {
                    return response()->json([
                        'success' => false,
                        'message' => 'ID sản phẩm không hợp lệ!'
                    ], 400);
                }
                if ($request->has('quantity')) {
                    // Kiểm tra tồn kho
                    $stockQuantity = 0;
                    if ($variantId) {
                        $variant = ProductVariant::find($variantId);
                        $stockQuantity = $variant ? $variant->stock_quantity : 0;
                    } else {
                        $product = Product::find($productId);
                        $stockQuantity = $product ? $product->stock_quantity : 0;
                    }
                    if ($request->quantity > $stockQuantity) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Số lượng vượt quá tồn kho hiện có!'
                        ], 400);
                    }
                    $cart[$request->item_id]['quantity'] = $request->quantity;
                    Session::put('cart', $cart);

                    // Tính lại tổng tiền giỏ hàng
                    $currentItem = $cart[$request->item_id];
                    $itemTotal = $currentItem['quantity'] * $currentItem['price_at_addition'];
                    $itemPrice = $currentItem['price_at_addition'];
                    $total = collect($cart)->sum(fn($item) => $item['quantity'] * $item['price_at_addition']);

                    // Recalc discount cho guest theo danh sách đã chọn
                    $discountAmount = 0;
                    $promotionId = Session::get('cart.promotion_id');
                    $selectedIds = Session::get('cart.discount_selected_items', []);
                    if ($promotionId && !empty($selectedIds)) {
                        $promotion = Promotion::find($promotionId);
                        if ($promotion) {
                            $selectedItems = collect($cart)->filter(function ($it, $key) use ($selectedIds) {
                                return in_array($key, $selectedIds);
                            });
                            $selectedTotal = $selectedItems->sum(fn($it) => $it['quantity'] * $it['price_at_addition']);
                            if ($promotion->min_order_value && $selectedTotal < $promotion->min_order_value) {
                                Session::forget('cart.discount');
                                Session::forget('cart.discount_code');
                                Session::forget('cart.promotion_id');
                                Session::forget('cart.discount_selected_items');
                                $discountAmount = 0;
                            } else {
                                if ($promotion->discount_type === 'percentage') {
                                    $discountAmount = ($selectedTotal * $promotion->discount_value) / 100;
                                    if ($promotion->max_discount_amount && $discountAmount > $promotion->max_discount_amount) {
                                        $discountAmount = $promotion->max_discount_amount;
                                    }
                                } elseif ($promotion->discount_type === 'fixed_amount') {
                                    $discountAmount = $promotion->discount_value;
                                }
                                Session::put('cart.discount', $discountAmount);
                            }
                        }
                    }

                    return response()->json([
                        'success' => true,
                        'item_total' => $itemTotal,
                        'item_price' => $itemPrice,
                        'subtotal' => $total,
                        'discount' => (int) ($discountAmount ?? 0)
                    ]);
                }
            }
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!'
            ], 404);
        }
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required'
        ]);

        if (Auth::check()) {
            // item_id dạng: productId_variantId (VD: 12_5 hoặc 12_null)
            $parts = explode('_', $request->item_id);
            $productId = $parts[0] ?? null;
            $variantId = $parts[1] ?? null;
            $variantId = $variantId === 'null' ? null : $variantId;

            $cart = Cart::where('user_id', Auth::id())->first();
            if (!$cart) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy giỏ hàng!'
                ], 404);
            }

            $cartItem = $cart->items()->where([
                'product_id' => $productId,
                'product_variant_id' => $variantId
            ])->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!'
                ], 404);
            }

            Log::info('Attempting to delete cart item from DB', [
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'product_variant_id' => $variantId
            ]);
            $cartItem->delete();
            $cartCount = $cart->items()->count();
            Log::info('Cart item deleted from DB', ['cart_count' => $cartCount]);
            // Recalc subtotal & discount sau khi xóa
            $total = $cart->items->sum(fn($item) => $item->quantity * $item->price_at_addition);
            $discountAmount = 0;
            $promotionId = Session::get('cart.promotion_id');
            $selectedIds = Session::get('cart.discount_selected_items', []);
            if ($promotionId && !empty($selectedIds)) {
                $promotion = Promotion::find($promotionId);
                if ($promotion) {
                    $selectedItems = $cart->items->filter(function ($it) use ($selectedIds) {
                        $key = $it->product_id . '_' . ($it->product_variant_id ?? 'null');
                        return in_array($key, $selectedIds);
                    });
                    $selectedTotal = $selectedItems->sum(fn($it) => $it->quantity * $it->price_at_addition);
                    if ($promotion->min_order_value && $selectedTotal < $promotion->min_order_value) {
                        Session::forget('cart.discount');
                        Session::forget('cart.discount_code');
                        Session::forget('cart.promotion_id');
                        Session::forget('cart.discount_selected_items');
                        $discountAmount = 0;
                    } else {
                        if ($promotion->discount_type === 'percentage') {
                            $discountAmount = ($selectedTotal * $promotion->discount_value) / 100;
                            if ($promotion->max_discount_amount && $discountAmount > $promotion->max_discount_amount) {
                                $discountAmount = $promotion->max_discount_amount;
                            }
                        } elseif ($promotion->discount_type === 'fixed_amount') {
                            $discountAmount = $promotion->discount_value;
                        }
                        Session::put('cart.discount', $discountAmount);
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
                'cartCount' => $cartCount,
                'subtotal' => $total,
                'discount' => (int) ($discountAmount ?? 0)
            ]);
        } else {
            // Guest: vẫn dùng key như cũ
            $cart = Session::get('cart', []);
            if (!isset($cart[$request->item_id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!'
                ], 404);
            }
            Log::info('Attempting to delete cart item from session', [
                'item_id' => $request->item_id,
                'current_cart' => $cart
            ]);
            unset($cart[$request->item_id]);
            Session::put('cart', $cart);
            Log::info('Cart item deleted from session', ['new_cart' => Session::get('cart')]);
            // Recalc subtotal & discount cho guest sau khi xóa
            $total = collect($cart)->sum(fn($item) => $item['quantity'] * $item['price_at_addition']);
            $discountAmount = 0;
            $promotionId = Session::get('cart.promotion_id');
            $selectedIds = Session::get('cart.discount_selected_items', []);
            if ($promotionId && !empty($selectedIds)) {
                $promotion = Promotion::find($promotionId);
                if ($promotion) {
                    $selectedItems = collect($cart)->filter(function ($it, $key) use ($selectedIds) {
                        return in_array($key, $selectedIds);
                    });
                    $selectedTotal = $selectedItems->sum(fn($it) => $it['quantity'] * $it['price_at_addition']);
                    if ($promotion->min_order_value && $selectedTotal < $promotion->min_order_value) {
                        Session::forget('cart.discount');
                        Session::forget('cart.discount_code');
                        Session::forget('cart.promotion_id');
                        Session::forget('cart.discount_selected_items');
                        $discountAmount = 0;
                    } else {
                        if ($promotion->discount_type === 'percentage') {
                            $discountAmount = ($selectedTotal * $promotion->discount_value) / 100;
                            if ($promotion->max_discount_amount && $discountAmount > $promotion->max_discount_amount) {
                                $discountAmount = $promotion->max_discount_amount;
                            }
                        } elseif ($promotion->discount_type === 'fixed_amount') {
                            $discountAmount = $promotion->discount_value;
                        }
                        Session::put('cart.discount', $discountAmount);
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
                'cartCount' => count($cart),
                'subtotal' => $total,
                'discount' => (int) ($discountAmount ?? 0)
            ]);
        }
    }

    public function clearCart()
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $itemCount = $cart->items()->count();

            if ($itemCount === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng đã trống!'
                ], 400);
            }

            $deleted = $cart->items()->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => "Đã xóa {$itemCount} sản phẩm khỏi giỏ hàng!"
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể xóa giỏ hàng!'
                ], 500);
            }
        } else {
            $cart = Session::get('cart', []);
            if (empty($cart)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng đã trống!',
                     'cartCount' => 0
                ], 400);
            }

            $itemCount = count($cart);
            Session::forget('cart');

            return response()->json([
                'success' => true,
                'message' => "Đã xóa {$itemCount} sản phẩm khỏi giỏ hàng!",
                'cartCount' => 0
            ]);
        }
    }
    private function getCartCount()
    {
        if (Auth::check()) {
            // Đếm từ database cho user đã đăng nhập
            $cart = Cart::where('user_id', Auth::id())->first();
            return $cart ? $cart->items()->count() : 0;
        } else {
            // Đếm từ session cho guest
            $items = Session::get('cart.items', []);
            return count($items);
        }
    }

  
    public function miniCart()
    {
        $cartItems = [];
        $cartCount = 0;

        if (Auth::check()) {
            // Lấy từ database cho user đã đăng nhập
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cartItems = CartItem::with([
                    'product.images',
                    'productVariant.image',
                    'productVariant.attributeValues.attribute'
                ])->where('cart_id', $cart->id)
                    ->orderByDesc('created_at')
                    ->limit(3)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'product' => $item->product,
                            'image_url' => $item->productVariant && $item->productVariant->image ? $item->productVariant->image->image_url : ($item->product && $item->product->images->first() ? $item->product->images->first()->image_url : 'images/products/no-image.png'),
                            'price_at_addition' => $item->price_at_addition,
                            'quantity' => $item->quantity,
                            'variant' => $item->productVariant,
                        ];
                    });
                $cartCount = $cart->items()->count();
            }
        } else {
            // Lấy từ session cho guest
            $sessionCart = Session::get('cart', []);
            $cartItems = collect($sessionCart)->reverse()->take(3)->map(function ($item) {
                $product = Product::with(['images'])->find($item['product_id']);
                // Nếu không tìm thấy product, trả về null hoặc giá trị mặc định
                if (!$product) {
                    return null;
                }
                // Nếu có variant thì lấy, không thì null
                $variant = !empty($item['product_variant_id']) ? ProductVariant::with(['attributeValues.attribute'])->find($item['product_variant_id']) : null;
                return [
                    'product' => $product,
                    'image_url' => $product->images->first() ? $product->images->first()->image_url : 'images/products/no-image.png',
                    'price_at_addition' => $item['price_at_addition'] ?? $item['price'] ?? 0,
                    'quantity' => $item['quantity'],
                    'variant' => $variant,
                ];
            })->filter()->values();
            $cartCount = count($sessionCart);
        }

        return view('client.partials.mini-cart', [
            'cartItems' => $cartItems,
            'cartCount' => $cartCount
        ])->render();
    }

    public function getVouchers()
    {
        // Lấy danh sách voucher khả dụng
        $vouchers = \App\Models\Promotion::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where(function ($query) {
                $query->whereNull('usage_limit_per_voucher')
                      ->orWhereRaw('times_used < usage_limit_per_voucher');
            })
            ->get();

        // Thêm thông tin về số lần sử dụng thực tế
        $vouchers->each(function ($voucher) {
            // Tính times_used thực tế từ bảng orders (chỉ đếm đơn hàng thành công)
            $actualTimesUsed = \App\Models\Order::where('discount_code', $voucher->code)
                ->whereNotIn('order_status', ['cancelled', 'failed', 'pending'])
                ->count();
            $voucher->times_used = $actualTimesUsed;
            
            if (Auth::check() && $voucher->usage_limit_per_user) {
                // Chỉ đếm đơn hàng thành công của user hiện tại
                $voucher->user_used_count = \App\Models\Order::where('user_id', Auth::id())
                    ->where('discount_code', $voucher->code)
                    ->whereNotIn('order_status', ['cancelled', 'failed', 'pending'])
                    ->count();
            } else {
                $voucher->user_used_count = 0;
            }
        });

        return view('client.cart.partials.voucher_list', [
            'vouchers' => $vouchers
        ])->render();
    }

    public function removeDiscount()
    {
        // Xóa thông tin voucher khỏi session
        Session::forget('cart.discount');
        Session::forget('cart.discount_code');
        Session::forget('cart.promotion_id');
    Session::forget('cart.discount_selected_items');

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa mã giảm giá!'
        ]);
    }

    /**
     * Validate cart items before checkout
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateCart(Request $request)
    {
        try {
            $cartItems = $request->input('cart_items', []);
            
            if (empty($cartItems)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng trống'
                ], 400);
            }

            // Validate cart items
            $cartValidationService = new CartValidationService();
            $validationResult = $cartValidationService->validateCartItems($cartItems);

            if ($validationResult['has_invalid_items']) {
                // Remove invalid items from cart
                $cartValidationService->removeInvalidItems($validationResult['invalid_items']);
                
                // Create error message
                $errorMessage = $cartValidationService->createErrorMessage($validationResult['invalid_items']);

                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => [
                        'invalid_items' => $validationResult['invalid_items'],
                        'valid_items' => $validationResult['valid_items'],
                        'has_invalid_items' => true
                    ]
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tất cả sản phẩm trong giỏ hàng đều hợp lệ',
                'data' => [
                    'valid_items' => $validationResult['valid_items'],
                    'has_invalid_items' => false
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi kiểm tra giỏ hàng: ' . $e->getMessage()
            ], 500);
        }
    }
}
