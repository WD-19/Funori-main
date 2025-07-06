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

class CartController
{
    public function cart()
    {
        $cartItems = [];
        $total = 0;
        $cartCount = 0;

        if (Auth::check()) {
            // Lấy cart từ database cho user đã đăng nhập
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cartItems = $cart->items()->with('product.images', 'product.variants')->get()->map(function($item) {
                    return [
                        'id' => $item->product_id . '_' . ($item->product_variant_id ?? 'null'),
                        'product_id' => $item->product_id,
                        'product_variant_id' => $item->product_variant_id,
                        'quantity' => $item->quantity,
                        'price_at_addition' => $item->price_at_addition,
                        'product' => $item->product ? $item->product->toArray() : null,
                    ];
                });
                $total = $cartItems->sum(function($item) {
                    return $item['quantity'] * $item['price_at_addition'];
                });
                $cartCount = $cartItems->count();
            }
        } else {
            // Lấy cart từ session cho guest
            $cart = Session::get('cart', []);
            $cartItems = collect($cart)->map(function($item) {
                $product = Product::with(['images', 'variants'])->find($item['product_id']);
                return [
                    'id' => $item['product_id'] . '_' . ($item['product_variant_id'] ?? 'null'),
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity' => $item['quantity'],
                    'price_at_addition' => $item['price'],
                    'product' => $product ? $product->toArray() : null,
                ];
            });
            $total = $cartItems->sum(function($item) {
                return $item['quantity'] * $item['price_at_addition'];
            });
            $cartCount = $cartItems->count();
        }

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

        // Lấy tồn kho phù hợp
        if ($productVariantId) {
            $variant = ProductVariant::find($productVariantId);
            $stockQuantity = $variant ? $variant->stock_quantity : 0;
        } else {
            $stockQuantity = $product->stock_quantity;
        }

        if (Auth::check()) {
            // Đã đăng nhập: lưu vào DB
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
                    'price_at_addition' => $product->regular_price
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
                'cart_count' => $cart->items()->count()
            ]);
        } else {
            // Guest: lưu vào session
            $cart = Session::get('cart', []);
            $key = $product->id . '_' . ($productVariantId ?? 'null');
            $currentCartQty = isset($cart[$key]) ? $cart[$key]['quantity'] : 0;

            if ($quantity + $currentCartQty > $stockQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng vượt quá tồn kho hiện có!'
                ], 400);
            }

            if (isset($cart[$key])) {
                $cart[$key]['quantity'] += $quantity;
            } else {
                $cart[$key] = [
                    'product_id' => $product->id,
                    'product_variant_id' => $productVariantId,
                    'quantity' => $quantity,
                    'price' => $product->regular_price
                ];
            }
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
            'quantity' => 'nullable|integer|min:1',
            'product_variant_id' => 'nullable|exists:product_variants,id'
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
                    // Xử lý cập nhật variant nếu có
                    if ($request->has('product_variant_id')) {
                        $newVariantId = $request->product_variant_id;
                        $newVariant = ProductVariant::find($newVariantId);
                        
                        if (!$newVariant) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Biến thể không tồn tại!'
                            ], 400);
                        }
                        
                        // Kiểm tra xem đã có item với variant mới chưa
                        $existingItem = $cart->items()->where([
                            'product_id' => $productId,
                            'product_variant_id' => $newVariantId
                        ])->where('id', '!=', $cartItem->id)->first();
                        
                        if ($existingItem) {
                            // Nếu đã có, cộng số lượng
                            $existingItem->quantity += $cartItem->quantity;
                            $existingItem->save();
                            $cartItem->delete();
                            $cartItem = $existingItem;
                        } else {
                            // Cập nhật variant
                            $cartItem->product_variant_id = $newVariantId;
                        }
                    }
                    
                    // Xử lý cập nhật số lượng nếu có
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
                
                // Xử lý cập nhật variant nếu có
                if ($request->has('product_variant_id')) {
                    $newVariantId = $request->product_variant_id;
                    $newVariant = ProductVariant::find($newVariantId);
                    
                    if (!$newVariant) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Biến thể không tồn tại!'
                        ], 400);
                    }
                    
                    // Tạo key mới cho variant mới
                    $newKey = $productId . '_' . ($newVariantId ?? 'null');
                    
                    // Kiểm tra xem đã có item với variant mới chưa
                    if (isset($cart[$newKey]) && $newKey !== $request->item_id) {
                        // Nếu đã có, cộng số lượng
                        $cart[$newKey]['quantity'] += $cart[$request->item_id]['quantity'];
                        unset($cart[$request->item_id]);
                    } else {
                        // Cập nhật variant
                        $cart[$request->item_id]['product_variant_id'] = $newVariantId;
                        if ($newKey !== $request->item_id) {
                            $cart[$newKey] = $cart[$request->item_id];
                            unset($cart[$request->item_id]);
                        }
                    }
                    
                    Session::put('cart', $cart);
                    
                    // Tính toán dữ liệu trả về cho guest
                    $currentItem = $cart[$newKey] ?? $cart[$request->item_id];
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
                
                // Xử lý cập nhật số lượng nếu có
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

    $parts = explode('_', $request->item_id);
    $productId = $parts[0] ?? null;
    $variantId = (!isset($parts[1]) || $parts[1] === 'null' || $parts[1] === '') ? null : $parts[1];

    if (!$productId) {
        return response()->json([
            'success' => false,
            'message' => 'ID sản phẩm không hợp lệ!'
        ], 400);
    }

    if (Auth::check()) {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
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

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
            'cart_count' => $cart->items()->count()
        ]);
    } else {
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
