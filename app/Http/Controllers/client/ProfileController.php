<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController 
{
    public function dashboard()
    {
        return view('client.profile.dashboard', [
            'pageTitle' => 'Dashboard'
        ]);
    }

    public function order()
    {
        return view('client.profile.order', [
            'pageTitle' => 'My Orders'
        ]);
    }

    public function address()
    {
        return view('client.profile.address', [
            'pageTitle' => 'Shipping Address'
        ]);
    }

    public function account()
    {
        return view('client.profile.account', [
            'pageTitle' => 'Account Details'
        ]);
    }

    public function wishlist(Request $request)
    {
        $user = Auth::user();
        $wishlist = $user->wishlist;
        if ($wishlist) {
            $query = $wishlist->items()->with('product.images');
            // Tìm kiếm theo tên sản phẩm
            if ($request->filled('search')) {
                $search = $request->input('search');
                $query = $query->whereHas('product', function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            }
            // Sắp xếp mới nhất
            if ($request->input('sort') === 'latest') {
                $query = $query->orderByDesc('created_at');
            }
            $wishlistItems = $query->paginate(9);
        } else {
            $wishlistItems = collect();
        }
        return view('client.profile.wishlist', compact('wishlistItems'));
    }
}
