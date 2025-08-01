<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Address;
use Illuminate\Support\Facades\Storage;
use App\Models\Order; // Add this at the top if not already imported
use App\Models\Promotion;

class ProfileController
{
    public function dashboard()
    {
        return view('client.profile.dashboard', [
            'pageTitle' => 'Dashboard'
        ]);
    }

    public function order(Request $request)
{
    $user = Auth::user();

    // Lọc trạng thái nếu có
    $status = $request->query('order_status', 'all');

    $ordersQuery = $user->orders()->latest(); // orderBy created_at DESC

    if ($status !== 'all') {
        $ordersQuery->where('order_status', $status);
    }

    $orders = $ordersQuery->get();

    return view('client.profile.order', [
        'pageTitle' => 'My Orders',
        'orders' => $orders // <-- chỉ truyền 1 danh sách, không groupBy nữa
    ]);
}

    public function detailOrder($orderId)
    {
        $user = Auth::user();
        $order = Order::with([
            'items.product',
            'items.productVariant.image',
            'items.productVariant.attributeValues.attribute',
            'items.product.thumbnail'
        ])->find($orderId);

        return view('client.profile.orderDetail', ['order' => $order]);
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
            'avatar_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validate ảnh
        ]);

        // Cập nhật thông tin chính
        // Sửa 'phone' thành 'phone_number' để khớp với các nơi khác và chỉ lấy các trường cần thiết
        $user->fill($request->only(['full_name', 'phone_number', 'email']));

        // Cập nhật mật khẩu nếu có
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar_url')) {
            // Xóa ảnh cũ nếu có
            if ($user->avatar_url) {
                Storage::disk('public')->delete($user->avatar_url);
            }
            // Lưu ảnh mới
            $path = $request->file('avatar_url')->store('images/avatar', 'public');
            $user->avatar_url = $path;
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

    public function editPassword()
    {
        return view('client.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'Mật khẩu mới không được trùng với mật khẩu hiện tại.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }

    /**
     * User request to cancel an order (chuyển trạng thái sang pending_cancellation)
     */
    public function cancelOrder(Request $request, Order $order)
    {
        // Nếu là request JSON (AJAX), merge dữ liệu vào $request
        if ($request->isJson()) {
            $request->merge($request->json()->all());
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:255',
            'cancel_reason_other' => 'nullable|string|max:255',
        ]);

        // Kiểm tra quyền và trạng thái đơn hàng
        if ($order->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Không có quyền hủy đơn hàng này!'], 403);
        }

        if (!in_array($order->order_status, ['pending_confirmation', 'processing'])) {
            return response()->json(['success' => false, 'message' => 'Đơn hàng không thể hủy ở trạng thái hiện tại!'], 400);
        }

        $reason = $request->cancellation_reason === 'other'
            ? $request->cancel_reason_other
            : $request->cancellation_reason;

        $order->order_status = 'cancelled';
        $order->cancelled_at = now();
        $order->cancellation_reason = $reason;
        $order->save();

        return response()->json(['success' => true]);
    }

    public function repeatOrder($id)
    {
        $order = Order::with('items')->findOrFail($id);

        // Lấy giỏ hàng hiện tại (theo user hoặc session)
        $cart = Auth::check()
            ? \App\Models\Cart::firstOrCreate(['user_id' => Auth::id()])
            : session()->get('cart', []);

        $repeatIds = [];

        foreach ($order->items as $item) {
            $key = $item->product_id . '_' . ($item->product_variant_id ?? 'null');
            $repeatIds[] = $key;

            // Tính đơn giá tại thời điểm đặt hàng
            $unitPrice = $item->quantity > 0 ? ($item->subtotal / $item->quantity) : 0;

            if (Auth::check()) {
                $cartItem = $cart->items()->where([
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id
                ])->first();

                if ($cartItem) {
                    $cartItem->quantity += $item->quantity;
                    $cartItem->save();
                } else {
                    $cart->items()->create([
                        'product_id' => $item->product_id,
                        'product_variant_id' => $item->product_variant_id,
                        'quantity' => $item->quantity,
                        'price_at_addition' => $unitPrice // <-- Lưu đơn giá vào cart
                    ]);
                }
            } else {
                $cartArr = session()->get('cart', []);
                if (isset($cartArr[$key])) {
                    $cartArr[$key]['quantity'] += $item->quantity;
                } else {
                    $cartArr[$key] = [
                        'product_id' => $item->product_id,
                        'product_variant_id' => $item->product_variant_id,
                        'quantity' => $item->quantity,
                        'price_at_addition' => $unitPrice // <-- Lưu đơn giá vào session
                    ];
                }
                session()->put('cart', $cartArr);
            }
        }

        // Chuyển hướng sang trang giỏ hàng, tick các sản phẩm vừa thêm
        return redirect()->route('client.view-cart')->with('repeat_ids', implode(',', $repeatIds));
    }

    public function vouchers()
    {
        $user = Auth::user();
        // Lấy các promotion còn hiệu lực, có thể lọc theo user nếu cần
        $vouchers = Promotion::where('is_active', 1)
            ->where(function($q){
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->get();
        return view('client.profile.voucher', compact('vouchers'));
    }

   

    public function ajaxOrderList(Request $request)
{
    $user = Auth::user();

    $status = $request->query('order_status', 'all');

    $ordersQuery = $user->orders()->latest(); // orderBy created_at DESC

    if ($status !== 'all') {
        $ordersQuery->where('order_status', $status);
    }

    $orders = $ordersQuery->get();

    return view('client.profile.order_list', [
        'orders' => $orders // <-- truyền 1 danh sách
    ])->render();
}

    public function markDelivered($orderId)
    {
        $user = Auth::user();
        $order = Order::where('id', $orderId)->where('user_id', $user->id)->firstOrFail();

        // Chấp nhận nhiều giá trị trạng thái giao hàng
        $shippingStatuses = ['shipped', 'shipping', 'dang_giao', 'Đang giao'];
        if (in_array($order->order_status, $shippingStatuses)) {
            $order->order_status = 'delivered';
            $order->delivered_at = now();
            $order->save();

            $order->status_histories()->create([
                'status' => 'delivered',
                'note' => 'Khách hàng xác nhận đã nhận hàng',
                'created_at' => now(),
            ]);
        }
        // Redirect về trang đơn hàng (hoặc trang trước đó)
        return redirect()->back();
    }
}
