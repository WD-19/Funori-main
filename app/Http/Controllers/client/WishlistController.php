<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Support\Facades\Auth;

class WishlistController
{
    public function add(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        if (!$user) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập!']);
            }
            return redirect()->back()->with('error', 'Bạn cần đăng nhập!');
        }
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $user->id
        ]);
        $exists = WishlistItem::where('wishlist_id', $wishlist->id)
            ->where('product_id', $productId)
            ->exists();

        if (!$exists) {
            WishlistItem::create([
                'wishlist_id' => $wishlist->id,
                'product_id' => $productId
            ]);
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Đã thêm vào yêu thích!']);
            }
            return redirect()->back()->with('success', 'Đã thêm vào yêu thích!');
        } else {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Sản phẩm đã có trong yêu thích!']);
            }
            return redirect()->back()->with('info', 'Sản phẩm đã có trong yêu thích!');
        }
    }

    public function remove(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        if (!$user) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập!']);
            }
            return redirect()->back()->with('error', 'Bạn cần đăng nhập!');
        }

        $wishlist = Wishlist::where('user_id', $user->id)->first();

        if ($wishlist) {
            WishlistItem::where('wishlist_id', $wishlist->id)
                ->where('product_id', $productId)
                ->delete();
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('client.profile.wishlist')->with('success', 'Đã xóa khỏi yêu thích!');
    }

    public function miniList()
    {
        $user = Auth::user();
        $wishlistItems = $user && $user->wishlist ? $user->wishlist->items()->with('product.images')->latest()->take(5)->get() : collect();
        return view('client.partials.mini-wishlist', compact('wishlistItems'))->render();
    }
}
