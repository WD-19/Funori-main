<?php

namespace App\Http\Controllers\client;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class CartController
{
    public function cart(Request $request)
    {
        $cartItems = [];
        $total = 0;
        $cartCount = 0;

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();

            if ($cart) {
                $cartItemsRaw = CartItem::with([
                    'product.images',
                    'product.variants',
                    'productVariant.image',
                    'productVariant.attributeValues.attribute'
                ])->where('cart_id', $cart->id)->get();

                foreach ($cartItemsRaw as $item) {
                    $product = $item->product;
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
                        'id' => $item->id,
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

            foreach ($sessionCart as $item) {
                // Sửa lỗi: Lấy giá trực tiếp từ session, không tính toán lại
                // để đảm bảo nhất quán với giá lúc thêm vào.
                $product = Product::with([
                    'images',
                    'variants.image',
                    'variants.attributeValues.attribute'
                ])->find($item['product_id']);

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
        }

        $total = array_sum(array_map(fn($item) => $item['quantity'] * $item['price_at_addition'], $cartItems));
        $cartCount = count($cartItems);

        // Đảm bảo dữ liệu giỏ hàng được lưu vào session['cart'] để checkout lấy được
        Session::put('cart.items', $cartItems);
        Session::put('cart.total', $total);
        // Có thể thêm các giá trị khác nếu cần (discount, shipping_fee...)

        $cartItems = collect($cartItems)->mapWithKeys(function ($item) {
            $key = $item['product_id'] . '_' . ($item['product_variant_id'] ?? 'null');
            return [$key => $item];
        })->toArray();

        // Lấy 8 sản phẩm mới nhất
        $newestProducts = Product::orderBy('created_at', 'desc')->take(8)->get();

        // Truyền sang view
        return view('client.cart.cart', compact('cartItems', 'total', 'cartCount', 'newestProducts'));
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
            // Guest
            $cart = Session::get('cart', []);
            $key = $product->id . '_' . ($productVariantId ?? 'null');
            $currentCartQty = isset($cart[$key]) ? $cart[$key]['quantity'] : 0;

            if ($quantity + $currentCartQty > $stockQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng vượt quá tồn kho hiện có!'
                ], 400);
            }

            $cart[$key] = [
                'product_id' => $product->id,
                'product_variant_id' => $productVariantId,
                'quantity' => $quantity,
                'price_at_addition' => $price // Sửa key 'price' thành 'price_at_addition' cho nhất quán
            ];

            Session::put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
                'cart_count' => count($cart)
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'quantity' => 'nullable|integer|min:1'
        ]);

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
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
                    // Chỉ cập nhật số lượng
                    if ($request->has('quantity')) {
                        // Lấy tồn kho phù hợp
                        $currentVariantId = $cartItem->product_variant_id;
                        if ($currentVariantId) {
                            $variant = ProductVariant::find($currentVariantId);
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
                    $cartItem->save();
                    $total = $cart->items->sum(fn($item) => $item->quantity * $item->price_at_addition);
                    return response()->json([
                        'success' => true,
                        'item_total' => $cartItem->quantity * $cartItem->price_at_addition,
                        'item_price' => $cartItem->price_at_addition,
                        'subtotal' => $total
                    ]);
                }
            }
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!'
            ], 404);
        } else {
            // Session
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
                // Chỉ cập nhật số lượng
                if ($request->has('quantity')) {
                    // Lấy tồn kho phù hợp
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
                    // Tính toán dữ liệu trả về cho guest
                    $currentItem = $cart[$request->item_id];
                    $itemTotal = $currentItem['quantity'] * $currentItem['price_at_addition'];
                    $itemPrice = $currentItem['price_at_addition'];
                    $total = collect($cart)->sum(fn($item) => $item['quantity'] * $item['price_at_addition']);
                    return response()->json([
                        'success' => true,
                        'item_total' => $itemTotal,
                        'item_price' => $itemPrice,
                        'subtotal' => $total
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
            $cartItem = CartItem::find($request->item_id);
            if (!$cartItem || $cartItem->cart->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!'
                ], 404);
            }

            $cartItem->delete();

            $cart = Cart::where('user_id', Auth::id())->first();
            $cartCount = $cart ? $cart->items()->count() : 0;

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
                'cartCount' => $cartCount
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
            unset($cart[$request->item_id]);
            Session::put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
                'cart_count' => count($cart)
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
                    'message' => 'Giỏ hàng đã trống!'
                ], 400);
            }

            $itemCount = count($cart);
            Session::forget('cart');

            return response()->json([
                'success' => true,
                'message' => "Đã xóa {$itemCount} sản phẩm khỏi giỏ hàng!"
            ]);
        }
    }
    private function getCartCount()
    {
        // giờ chỉ cần đếm trong session('cart.items')
        $items = Session::get('cart.items', []);
        return count($items);
    }

    /**
     * Lấy dữ liệu mini cart cho AJAX request
     */
    // public function getMiniCart()
    // {
    //     $cartItems = [];
    //     $cartCount = 0;
    //     $total = 0;

    //     if (Auth::check()) {
    //         $cart = Cart::where('user_id', Auth::id())->first();

    //         if ($cart) {
    //             $cartItemsRaw = CartItem::with([
    //                 'product.images',
    //                 'productVariant.image',
    //                 'productVariant.attributeValues.attribute'
    //             ])->where('cart_id', $cart->id)
    //               ->orderByDesc('created_at')
    //               ->limit(3)
    //               ->get();

    //             foreach ($cartItemsRaw as $item) {
    //                 $product = $item->product;
    //                 $variant = $item->productVariant;

    //                 // Lấy ảnh biến thể nếu có, ưu tiên thumbnail nếu có
    //                 $imageUrl = null;
    //                 $variantImage = null;
    //                 if ($variant && $variant->image && $variant->image->image_url) {
    //                     $variantImage = $variant->image->image_url;
    //                 }

    //                 if ($variantImage) {
    //                     $imageUrl = $variantImage;
    //                 } elseif ($product && $product->images && $product->images->first()) {
    //                     $imageUrl = $product->images->first()->image_url;
    //                 } else {
    //                     $imageUrl = 'images/products/no-image.png';
    //                 }

    //                 $cartItems[] = [
    //                     'id' => $item->id,
    //                     'product_id' => $product->id,
    //                     'product_variant_id' => $variant->id ?? null,
    //                     'quantity' => $item->quantity,
    //                     'price_at_addition' => $item->price_at_addition,
    //                     'image_url' => $imageUrl,
    //                     'product' => [
    //                         'id' => $product->id,
    //                         'name' => $product->name,
    //                         'slug' => $product->slug,
    //                     ],
    //                     'variant' => $variant ? [
    //                         'id' => $variant->id,
    //                         'image' => $variant->image ? [
    //                             'image_url' => $variant->image->image_url
    //                         ] : null,
    //                     ] : null,
    //                 ];
    //             }

    //             $cartCount = $cart->items()->count();
    //             $total = $cart->items->sum(fn($item) => $item->quantity * $item->price_at_addition);
    //         }
    //     } else {
    //         // Guest cart from session
    //         $sessionCart = Session::get('cart', []);
    //         $cartItems = collect($sessionCart)
    //             ->take(3)
    //             ->map(function ($item) {
    //                 $product = Product::with([
    //                     'images',
    //                     'variants.image',
    //                     'variants.attributeValues.attribute'
    //                 ])->find($item['product_id']);

    //                 $variant = null;
    //                 $imageUrl = null;

    //                 if (!empty($item['product_variant_id']) && $product) {
    //                     $variant = ProductVariant::with([
    //                         'image',
    //                         'attributeValues.attribute'
    //                     ])->find($item['product_variant_id']);

    //                     if ($variant && $variant->image) {
    //                         $imageUrl = $variant->image->image_url;
    //                     }
    //                 }

    //                 if (!$imageUrl && $product && $product->images->first()) {
    //                     $imageUrl = $product->images->first()->image_url;
    //                 }

    //                 if (!$imageUrl) {
    //                     $imageUrl = 'images/products/no-image.png';
    //                 }

    //                 return [
    //                     'id' => $item['product_id'] . '_' . ($item['product_variant_id'] ?? 'null'),
    //                     'product_id' => $item['product_id'],
    //                     'product_variant_id' => $item['product_variant_id'],
    //                     'quantity' => $item['quantity'],
    //                     'price_at_addition' => $item['price'],
    //                     'image_url' => $imageUrl,
    //                     'product' => $product ? [
    //                         'id' => $product->id,
    //                         'name' => $product->name,
    //                         'slug' => $product->slug,
    //                     ] : null,
    //                     'variant' => $variant ? [
    //                         'id' => $variant->id,
    //                         'image' => $variant->image ? [
    //                             'image_url' => $variant->image->image_url
    //                         ] : null,
    //                     ] : null,
    //                 ];
    //             })
    //             ->values()
    //             ->all();

    //         $cartCount = count($sessionCart);
    //         $total = collect($sessionCart)->sum(fn($item) => $item['quantity'] * $item['price']);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'cart_items' => $cartItems,
    //         'cart_count' => $cartCount,
    //         'total' => $total,
    //         'has_more' => $cartCount > 3
    //     ]);
    // }

    public function miniCart()
    {
        $cartItems = [];
        $cartCount = 0;

        if (Auth::check()) {
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
            $sessionCart = Session::get('cart', []);
            $cartItems = collect($sessionCart)->reverse()->take(3)->map(function ($item) {
                $product = Product::with(['images'])->find($item['product_id']);
                // Nếu có variant thì lấy, không thì null
                $variant = !empty($item['product_variant_id']) ? \App\Models\ProductVariant::with(['attributeValues.attribute'])->find($item['product_variant_id']) : null;
                return [
                    'product' => $product,
                    'image_url' => $product && $product->images->first() ? $product->images->first()->image_url : 'images/products/no-image.png',
                    'price_at_addition' => $item['price'],
                    'quantity' => $item['quantity'],
                    'variant' => $variant,
                ];
            })->values();
            $cartCount = count($sessionCart);
        }

        return view('client.partials.mini-cart', [
            'cartItems' => $cartItems,
            'cartCount' => $cartCount
        ])->render();
    }
}
