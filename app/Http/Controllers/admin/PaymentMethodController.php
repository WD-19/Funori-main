<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController
{
    public function index(Request $request)
    {
        $query = PaymentMethod::query();

        // Lọc theo tên nếu có nhập từ khóa
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }


        $methods = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.payment_method.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.payment_method.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:payment_methods,name',
            'code' => 'required|string|max:50|unique:payment_methods,code',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
        ], [
            'name.unique' => 'Tên phương thức này đã tồn tại.',
            'name.required' => 'Vui lòng nhập tên phương thức.',
            'name.string' => 'Tên phương thức phải là chuỗi.',
            'name.max' => 'Tên phương thức không được vượt quá 100 ký tự.',

            'code.required' => 'Vui lòng nhập mã phương thức.',
            'code.string' => 'Mã phương thức phải là chuỗi.',
            'code.max' => 'Mã phương thức không được vượt quá 50 ký tự.',
            'code.unique' => 'Mã phương thức này đã tồn tại.',

            'description.string' => 'Mô tả phải là chuỗi.',
            'instructions.string' => 'Hướng dẫn phải là chuỗi.',
        ]);

        PaymentMethod::create($request->all());

         return redirect()->route('admin.payment_methods.index')
        ->with('success', 'Đã thêm phương thức thanh toán!');
    }

    public function edit($id)
    {
        $method = PaymentMethod::findOrFail($id);
        return view('admin.payment_method.edit', compact('method'));
    }

    public function update(Request $request, $id)
    {
        $method = PaymentMethod::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:100|unique:payment_methods,name,' . $id,
            'code' => 'required|string|max:50|unique:payment_methods,code,' . $id,
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
        ], [
            'name.unique' => 'Tên phương thức này đã tồn tại.',
            'name.required' => 'Vui lòng nhập tên phương thức.',
            'name.string' => 'Tên phương thức phải là chuỗi.',
            'name.max' => 'Tên phương thức không được vượt quá 100 ký tự.',
            'code.required' => 'Vui lòng nhập mã phương thức.',
            'code.string' => 'Mã phương thức phải là chuỗi.',
            'code.max' => 'Mã phương thức không được vượt quá 50 ký tự.',
            'code.unique' => 'Mã phương thức này đã tồn tại.',
            'description.string' => 'Mô tả phải là chuỗi.',
            'instructions.string' => 'Hướng dẫn phải là chuỗi.',
        ]);
        $method->update($request->all());
        return redirect()->route('admin.payment_methods.index')
            ->with('success', 'Cập nhật phương thức thanh toán thành công!');
    }

    public function destroy($id)
    {
        PaymentMethod::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa!');
    }

    public function toggle($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->is_active = !$method->is_active;
        $method->save();

        return redirect()->back()->with('success', 'Trạng thái đã được cập nhật!');
    }
}
