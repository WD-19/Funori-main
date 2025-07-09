<?php

namespace App\Http\Controllers\client;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController
{
    public function cart()
    {
        if (!Auth::check()) {
            return redirect()->route('client.login');
        }

        $cartItems = [];
        $total = 0;
        
        // Lấy cart từ database cho user đã đăng nhập
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cartItems = $cart->items()->with('product.images')->get();
            $total = $cartItems->sum(function($item) {
                return $item->quantity * $item->price_at_addition;
            });
        }
        
        return view('client.cart.cart', compact('cartItems', 'total'));
    }

    public function addToCart(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'product_variant_id' => 'nullable|exists:product_variants,id'
            ]);

            $product = Product::findOrFail($request->product_id);
            $quantity = $request->quantity;
            $productVariantId = $request->product_variant_id;

            // Lấy tồn kho
            if ($productVariantId) {
                $variant = $product->variants()->find($productVariantId);
                if (!$variant) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy biến thể sản phẩm.'
                    ], 400);
                }
                $stock = $variant->stock_quantity;
            } else {
                $stock = $product->stock_quantity;
            }

            // Tính tổng số lượng đã có trong giỏ (nếu có)
            $currentCartQty = 0;
            if (Auth::check()) {
                $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
                $existingItem = $cart->items()
                    ->where('product_id', $product->id)
                    ->where('product_variant_id', $productVariantId)
                    ->first();
                if ($existingItem) {
                    $currentCartQty = $existingItem->quantity;
                }
            } else {
                $cart = Session::get('cart', []);
                $key = $product->id . '_' . ($productVariantId ?? 'null');
                if (isset($cart[$key])) {
                    $currentCartQty = $cart[$key]['quantity'];
                }
            }

            // Kiểm tra tồn kho
            if ($quantity + $currentCartQty > $stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng vượt quá tồn kho hiện có!'
                ], 400);
            }

            $price = $product->regular_price;
            if ($productVariantId) {
                $price += $variant->price_modifier;
            }

            if (Auth::check()) {
                // Xử lý cho user đã đăng nhập
                $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
                
                // Kiểm tra xem sản phẩm đã có trong cart chưa
                $existingItem = $cart->items()
                    ->where('product_id', $product->id)
                    ->where('product_variant_id', $productVariantId)
                    ->first();

                if ($existingItem) {
                    $existingItem->update([
                        'quantity' => $existingItem->quantity + $quantity
                    ]);
                } else {
                    $cart->items()->create([
                        'product_id' => $product->id,
                        'product_variant_id' => $productVariantId,
                        'quantity' => $quantity,
                        'price_at_addition' => $product->regular_price // SỬA Ở ĐÂY
                    ]);
                }
            } else {
                // Xử lý cho khách (session)
                $cart = Session::get('cart', []);
                $key = $product->id . '_' . ($productVariantId ?? 'null');
                
                if (isset($cart[$key])) {
                    $cart[$key]['quantity'] += $quantity;
                } else {
                    $cart[$key] = [
                        'product_id' => $product->id,
                        'product_variant_id' => $productVariantId,
                        'quantity' => $quantity,
                        'price' => $product->price,
                        'product' => $product
                    ];
                }
                
                Session::put('cart', $cart);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
                'cart_count' => $this->getCartCount()
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            $cartItem = CartItem::where('id', $request->item_id)
                ->whereHas('cart', function($query) {
                    $query->where('user_id', Auth::id());
                })->firstOrFail();
            
            $cartItem->update(['quantity' => $request->quantity]);
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$request->item_id])) {
                $cart[$request->item_id]['quantity'] = $request->quantity;
                Session::put('cart', $cart);
            }
        }

        $total = 0;
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $total = $cart->items()->sum(DB::raw('quantity * price_at_addition'));
            }
        }
        return response()->json(['success' => true, 'subtotal' => $total]);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required'
        ]);

        if (Auth::check()) {
            $cartItem = CartItem::where('id', $request->item_id)
                ->whereHas('cart', function($query) {
                    $query->where('user_id', Auth::id());
                })->firstOrFail();
            
            $cartItem->delete();
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$request->item_id])) {
                unset($cart[$request->item_id]);
                Session::put('cart', $cart);
            }
        }

        return response()->json(['success' => true]);
    }

    public function clearCart()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cart->items()->delete();
            }
        } else {
            Session::forget('cart');
        }

        return response()->json(['success' => true]);
    }

    private function getCartCount()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            return $cart ? $cart->items()->sum('quantity') : 0;
        } else {
            $cart = Session::get('cart', []);
            return collect($cart)->sum('quantity');
        }
    }
}
