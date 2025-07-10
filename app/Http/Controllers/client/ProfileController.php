<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

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
        $addresses = Auth::user()->addresses; // Lấy danh sách địa chỉ của user
        return view('client.profile.address', [
            'pageTitle' => 'Shipping Address',
            'addresses' => $addresses
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

    public function updateAccount(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu có và không phải ảnh mặc định
            if ($user->avatar_url && !str_contains($user->avatar_url, 'default-avatar.png')) {
                $oldPath = str_replace('storage/', '', $user->avatar_url);
                Storage::disk('public')->delete($oldPath);
            }
            // Lưu ảnh mới
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_url = 'storage/' . $avatarPath;
        }

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }
}
