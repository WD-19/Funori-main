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
    public function cart()
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
                    'productVariant.image', // Nếu chỉ có 1 ảnh
                    // 'productVariant.images', // Nếu có nhiều ảnh, dùng dòng này và sửa dưới
                    'productVariant.attributeValues.attribute'
                ])->where('cart_id', $cart->id)->get();
    
                foreach ($cartItemsRaw as $item) {
                    $product = $item->product;
                    $variant = $item->productVariant;
    
                    // Lấy ảnh biến thể nếu có, ưu tiên thumbnail nếu có
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
                $product = Product::with([
                    'images',
                    'variants.image',
                    'variants.attributeValues.attribute'
                ])->find($item['product_id']);
    
                $variant = null;
                $variantAttributes = [];
                $price = $product->regular_price ?? 0;
                $variantImage = null;
    
                if (!empty($item['product_variant_id']) && $product) {
                    $variant = ProductVariant::with([
                        'image',
                        'attributeValues.attribute'
                    ])->find($item['product_variant_id']);
    
                    if ($variant) {
                        $variantImage = optional($variant->image)->image_url;
                        $price += (float)($variant->price_modifier ?? 0);
                        $variantAttributes = $variant->attributeValues
                            ? $variant->attributeValues->map(function ($attrVal) {
                                return (optional($attrVal->attribute)->name ?? '') . ': ' . ($attrVal->value ?? '');
                            })->filter()->toArray()
                            : [];
                    }
                }
    
                $productImage = optional($product->images->first())->image_url;
                $imageUrl = $variantImage ?? $productImage ?? asset('images/products/no-image.png');
    
                $cartItems[] = [
                    'id' => $item['product_id'] . '_' . ($item['product_variant_id'] ?? 'null'),
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity' => $item['quantity'],
                    'price_at_addition' => $price,
                    'image_url' => $imageUrl,
                    'product' => $product ? $product->toArray() : null,
                    'variant_attributes' => $variantAttributes,
                    'variant' => $variant ? $variant->toArray() : null,

                ];
            }
        }
    
        $total = array_sum(array_map(fn($item) => $item['quantity'] * $item['price_at_addition'], $cartItems));
        $cartCount = count($cartItems);
        
  //       dd($cartItems);
        $cartItems = collect($cartItems)->mapWithKeys(function ($item) {
            $key = $item['product_id'] . '_' . ($item['product_variant_id'] ?? 'null');
            return [$key => $item]; // giữ nguyên toàn bộ item, không mất dữ liệu
        })->toArray();
        return view('client.cart.cart', compact('cartItems', 'total', 'cartCount'));
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
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'product_variant_id' => $productVariantId,
                    'quantity' => $quantity,
                    'price_at_addition' => $price
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
                'cart_count' => $cart->items()->count()
            ]);
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
                'price' => $price
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
                    $itemTotal = $currentItem['quantity'] * $currentItem['price'];
                    $itemPrice = $currentItem['price'];
                    $total = collect($cart)->sum(fn($item) => $item['quantity'] * $item['price']);
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
                'cart_count' => $cartCount
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
        $cart = Session::get('cart', []);
        // Đếm số sản phẩm khác nhau (mỗi key là 1 sản phẩm)
        return count($cart);
    }
}
