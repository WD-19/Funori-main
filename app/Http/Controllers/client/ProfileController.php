<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Address;
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
        $user = Auth::user();

        return view('client.profile.account', [
            'pageTitle' => 'Account Details',
            'user' => $user
        ]);
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => ['required', 'string', 'max:15', Rule::unique('users', 'phone_number')->ignore($user->id, 'id')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Cập nhật thông tin chính
        // Sửa 'phone' thành 'phone_number' để khớp với các nơi khác và chỉ lấy các trường cần thiết
        $user->fill($request->only(['full_name', 'phone_number', 'email']));

        // Cập nhật mật khẩu nếu có
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Cập nhật thông tin tài khoản thành công!');
    }
    public function storeAddress(Request $request)
    {
        $request->validate([
            'receiver_name' => ['required', 'string', 'min:5'],
            'receiver_phone' => ['required', 'regex:/^0\d{9}$/'],
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'street_address' => ['required', 'string'],
        ], [
            'receiver_name.required' => 'Vui lòng nhập họ và tên.',
            'receiver_name.min' => 'Họ và tên phải dài hơn 5 ký tự.',
            'receiver_phone.required' => 'Vui lòng nhập số điện thoại.',
            'receiver_phone.regex' => 'Số điện thoại phải gồm 10 số và bắt đầu bằng số 0.',
            'street_address.required' => 'Vui lòng nhập địa chỉ cụ thể.',
            'province.required' => 'Vui lòng chọn Tỉnh/Thành phố.',
            'district.required' => 'Vui lòng chọn Quận/Huyện.',
            'ward.required' => 'Vui lòng chọn Phường/Xã.',
            'street_address.required' => 'Vui lòng nhập địa chỉ cụ thể.',
        ]);

        // Nếu chọn mặc định, bỏ mặc định các địa chỉ khác
        if ($request->has('is_default')) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        Address::create([
            'user_id' => Auth::id(),
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
            'street_address' => $request->street_address,
            'is_default' => $request->has('is_default') ? 1 : 0,
        ]);

        return back()->with('success', 'Đã thêm địa chỉ mới thành công!');
    }

    public function editAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }
        return response()->json($address);
    }

    public function updateAddress(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }
        $request->validate([
            'receiver_name' => ['required', 'string', 'min:5'],
            'receiver_phone' => ['required', 'regex:/^0\d{9}$/'],
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'street_address' => ['required', 'string'],
        ]);

        $address->update([
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
            'street_address' => $request->street_address,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Cập nhật địa chỉ thành công!']);
        }
        return back()->with('success', 'Đã cập nhật địa chỉ!');
    }

    public function destroyAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }
        $address->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Đã xóa địa chỉ!');
    }

    public function setDefaultAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }
        // Bỏ mặc định các địa chỉ khác
        Address::where('user_id', Auth::id())->update(['is_default' => false]);
        // Đặt mặc định cho địa chỉ này
        $address->is_default = true;
        $address->save();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Đã cập nhật địa chỉ mặc định!');
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
                $query = $query->whereHas('product', function ($q) use ($search) {
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
