<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

$currentUser = Auth::user();

class UserController
{
   public function index(Request $request)
   {
      $query = User::query();

      // Tìm kiếm theo tên
      if ($request->filled('name')) {
          $query->where('full_name', 'like', '%' . $request->name . '%');
      }

      // Lọc chung role và status_account
      if ($request->filled('filter')) {
          $filter = $request->filter;
          if (in_array($filter, ['admin', 'user'])) {
              $query->where('role', $filter);
          } elseif (in_array($filter, ['active', 'inactive', 'banned'])) {
              $query->where('account_status', $filter);
          }
      }

      $users = $query->orderBy('created_at', 'desc')->paginate(10);

      return view('admin.users.index', compact('users'));
   }

   public function create()
   {
      $users = User::all();
      return view('admin.users.create', compact('users'));
   }

   public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'full_name'      => 'required|string|max:255',
        'email'          => 'required|email|unique:users,email',
        'phone_number'   => 'required|string|max:20',
        'password'       => 'required|string|min:6|confirmed',
        'avatar_url'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'account_status' => 'required|in:active,inactive,banned',
        'role'           => 'required|in:admin,user',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $user = new User();
    $user->full_name = $request->full_name;
    $user->email = $request->email;
    $user->phone_number = $request->phone_number;
    $user->role = $request->role;
    $user->account_status = $request->account_status;
    $user->password = bcrypt($request->password);

    // Upload avatar to public/images/users
    if ($request->hasFile('avatar_url')) {
        $file = $request->file('avatar_url');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/users'), $filename);
        $user->avatar_url = 'images/users/' . $filename;
    }

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Thêm user thành công!');
}

   public function show($id)
   {
      $user = User::findOrFail($id);
      return view('admin.users.detail', compact('user'));
   }

   public function edit($id){
      $user = User::findOrFail($id);
      return view('admin.users.edit', compact('user'));
   }

   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $currentUser = Auth::user();

    // Không cho admin sửa thông tin của admin khác
    if ($user->role === 'admin' && $currentUser->id !== $user->id) {
        return redirect()->back()->with('error', 'Bạn không có quyền sửa thông tin admin khác.');
    }

    // Nếu là admin sửa chính mình: chỉ cho phép sửa thông tin cá nhân, không cho sửa role và account_status
    if ($currentUser->id === $user->id && $currentUser->role === 'admin') {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Xử lý upload avatar nếu có
        if ($request->hasFile('avatar_url')) {
            $file = $request->file('avatar_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/users'), $filename);
            $validated['avatar_url'] = 'images/users/' . $filename;
        }

        $user->update($validated);
        return redirect()->route('admin.users.edit', $user->id)->with('success', 'Cập nhật thành công.');
    }

    // Nếu là admin sửa user thường: chỉ cho phép sửa role và account_status
    if ($currentUser->role === 'admin' && $user->role !== 'admin') {
        $validated = $request->validate([
            'account_status' => 'required|in:active,inactive,banned',
            'role' => 'required|in:admin,user',
        ]);
        $user->update([
            'role' => $validated['role'],
            'account_status' => $validated['account_status'],
        ]);
        return redirect()->route('admin.users.edit', $user->id)->with('success', 'Cập nhật thành công.');
    }

    // Các trường hợp khác (không có quyền)
    return redirect()->back()->with('error', 'Bạn không có quyền thực hiện thao tác này.');
}



   public function orderHistory($id)
   {
      $user = User::findOrFail($id);
      $orders = Order::where('user_id', $id)->orderBy('created_at', 'desc')->get();

      return view('admin.users.orderHistory', compact('user', 'orders'));
   }

}
