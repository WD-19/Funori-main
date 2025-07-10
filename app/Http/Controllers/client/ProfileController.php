<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Address;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
        return view('client.profile.account', [ 'pageTitle' => 'Account Details', 'user' => $user
        ]);
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();
 
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:15', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'address' => 'nullable|string|max:255',
            // Nếu người dùng nhập địa chỉ cụ thể, thì Tỉnh/Quận/Phường là bắt buộc
            'province' => ['required_with:address', 'nullable', 'string', 'max:255'],
            'district' => ['required_with:address', 'nullable', 'string', 'max:255'],
            'ward' => ['required_with:address', 'nullable', 'string', 'max:255'],
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            // Thêm thông báo lỗi tùy chỉnh
            'province.required_with' => 'Vui lòng chọn Tỉnh/Thành phố khi đã nhập địa chỉ cụ thể.',
            'district.required_with' => 'Vui lòng chọn Quận/Huyện khi đã nhập địa chỉ cụ thể.',
            'ward.required_with' => 'Vui lòng chọn Phường/Xã khi đã nhập địa chỉ cụ thể.',
        ]);

        // Cập nhật thông tin chính
        $user->fill($request->only(['full_name', 'phone', 'email', 'address', 'province', 'district', 'ward']));

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
            'street_address' => ['required', 'string'],
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
        ], [
            'receiver_name.required' => 'Vui lòng nhập họ và tên.',
            'receiver_name.min' => 'Họ và tên phải dài hơn 5 ký tự.',
            'receiver_phone.required' => 'Vui lòng nhập số điện thoại.',
            'receiver_phone.regex' => 'Số điện thoại phải gồm 10 số và bắt đầu bằng số 0.',
            'street_address.required' => 'Vui lòng nhập địa chỉ cụ thể.',
            'province.required' => 'Vui lòng chọn Tỉnh/Thành phố.',
            'district.required' => 'Vui lòng chọn Quận/Huyện.',
            'ward.required' => 'Vui lòng chọn Phường/Xã.',
        ]);

        // Nếu chọn mặc định, bỏ mặc định các địa chỉ khác
        if ($request->has('is_default')) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        Address::create([
            'user_id' => Auth::id(),
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'street_address' => $request->street_address,
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
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
            'street_address' => ['required', 'string'],
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
        ]);

        $address->update($request->all());

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

    public function password()
    {
        return view('client.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ], [
            'new_password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu cũ không đúng.');
        }

        // Nếu giống mật khẩu cũ thì báo lỗi
        if (Hash::check($request->new_password, $user->password)) {
            return back()->with('error', 'Mật khẩu mới không được trùng với mật khẩu cũ.');
        }

        // Đổi mật khẩu
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}
