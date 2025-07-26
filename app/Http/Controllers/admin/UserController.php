<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
       ], [
           'full_name.required' => 'Họ và tên là bắt buộc.',
           'full_name.string' => 'Họ và tên phải là chuỗi ký tự.',
           'full_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
           'email.required' => 'Email là bắt buộc.',
           'email.email' => 'Email không đúng định dạng.',
           'email.unique' => 'Email đã tồn tại, vui lòng chọn email khác.',
           'phone_number.required' => 'Số điện thoại là bắt buộc.',
           'phone_number.string' => 'Số điện thoại phải là chuỗi ký tự.',
           'phone_number.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
           'password.required' => 'Mật khẩu là bắt buộc.',
           'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
           'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
           'avatar_url.image' => 'Tệp avatar phải là hình ảnh.',
           'avatar_url.mimes' => 'Tệp avatar phải có định dạng: jpeg, png, jpg, gif.',
           'avatar_url.max' => 'Kích thước avatar không được vượt quá 2MB.',
           'account_status.required' => 'Trạng thái tài khoản là bắt buộc.',
           'account_status.in' => 'Trạng thái tài khoản không hợp lệ.',
           'role.required' => 'Quyền là bắt buộc.',
           'role.in' => 'Quyền không hợp lệ.',
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

       return redirect()->route('admin.users.index')->with('success', 'Thêm người dùng thành công!');
   }

   public function show($id)
   {
      $user = User::findOrFail($id);
      return view('admin.users.detail', compact('user'));
   }

   public function edit($id)
   {
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
               'avatar_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
           ], [
               'full_name.required' => 'Họ và tên là bắt buộc.',
               'full_name.string' => 'Họ và tên phải là chuỗi ký tự.',
               'full_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
               'email.required' => 'Email là bắt buộc.',
               'email.email' => 'Email không đúng định dạng.',
               'email.max' => 'Email không được vượt quá 255 ký tự.',
               'email.unique' => 'Email đã tồn tại, vui lòng chọn email khác.',
               'phone_number.string' => 'Số điện thoại phải là chuỗi ký tự.',
               'phone_number.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
               'avatar_url.image' => 'Tệp avatar phải là hình ảnh.',
               'avatar_url.mimes' => 'Tệp avatar phải có định dạng: jpeg, png, jpg, gif.',
               'avatar_url.max' => 'Kích thước avatar không được vượt quá 2MB.',
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
           ], [
               'account_status.required' => 'Trạng thái tài khoản là bắt buộc.',
               'account_status.in' => 'Trạng thái tài khoản không hợp lệ.',
               'role.required' => 'Quyền là bắt buộc.',
               'role.in' => 'Quyền không hợp lệ.',
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

   public function resetPassword(Request $request, $id)
   {
       $user = User::findOrFail($id);

       // Chỉ cho phép đổi mật khẩu nếu là chính mình
       if (Auth::id() !== $user->id) {
           return back()->withErrors(['Bạn chỉ có thể đổi mật khẩu của chính mình.']);
       }

       $request->validate([
           'old_password' => 'required',
           'new_password' => 'required|min:6|confirmed',
       ], [
           'old_password.required' => 'Mật khẩu cũ là bắt buộc.',
           'new_password.required' => 'Mật khẩu mới là bắt buộc.',
           'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
           'new_password.confirmed' => 'Xác nhận mật khẩu không khớp.',
       ]);

       // Kiểm tra mật khẩu cũ
       if (!Hash::check($request->old_password, $user->password)) {
           return back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng.']);
       }

       // Đổi mật khẩu
       $user->password = bcrypt($request->new_password);
       $user->save();

       return back()->with('success', 'Đổi mật khẩu thành công!');
   }
}