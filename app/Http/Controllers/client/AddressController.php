<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController
{
    public function store(Request $request)
    {
        $request->validate([
            'receiver_name' => ['required', 'string', 'min:8'],
            'receiver_phone' => ['required', 'regex:/^0\d{9}$/'],
            'street_address' => ['required', 'string'],
        ], [
            'receiver_name.required' => 'Vui lòng nhập họ và tên.',
            'receiver_name.min' => 'Họ và tên phải dài hơn 8 ký tự.',
            'receiver_phone.required' => 'Vui lòng nhập số điện thoại.',
            'receiver_phone.regex' => 'Số điện thoại phải gồm 10 số và bắt đầu bằng số 0.',
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
            'street_address' => $request->street_address,
            'is_default' => $request->has('is_default') ? 1 : 0,
        ]);

        return back()->with('success', 'Đã thêm địa chỉ!');
    }

    public function destroy(Address $address)
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

    public function setDefault(Address $address)
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

public function edit(Address $address)
{
    if ($address->user_id !== Auth::id()) {
        abort(403);
    }
    return response()->json($address);
}

public function update(Request $request, Address $address)
{
    if ($address->user_id !== Auth::id()) {
        abort(403);
    }
    $request->validate([
        'receiver_name' => ['required', 'string', 'min:8'],
        'receiver_phone' => ['required', 'regex:/^0\d{9}$/'],
        'street_address' => ['required', 'string'],
    ], [
        'receiver_name.required' => 'Vui lòng nhập họ và tên.',
        'receiver_name.min' => 'Họ và tên phải dài hơn 8 ký tự.',
        'receiver_phone.required' => 'Vui lòng nhập số điện thoại.',
        'receiver_phone.regex' => 'Số điện thoại phải gồm 10 số và bắt đầu bằng số 0.',
        'street_address.required' => 'Vui lòng nhập địa chỉ cụ thể.',
    ]);

    $address->receiver_name = $request->receiver_name;
    $address->receiver_phone = $request->receiver_phone;
    $address->street_address = $request->street_address;
    $address->save();

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }
    return back()->with('success', 'Đã cập nhật địa chỉ!');
}
}
