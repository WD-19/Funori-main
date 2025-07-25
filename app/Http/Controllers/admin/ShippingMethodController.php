<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController
{
    public function index(Request $request)
{
    $query = ShippingMethod::query();

    // Nếu người dùng nhập từ khóa tìm kiếm
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->input('name') . '%');
    }

    // Nếu có phân trang
    $methods = $query->orderBy('id', 'desc')->paginate(10);

    return view('admin.shipping_method.index', compact('methods'));
}

    public function create()
    {
        return view('admin.shipping_method.create');
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'nullable|string',
        'cost' => 'required|numeric|min:0',
    ], [
        'name.required' => 'Vui lòng nhập tên phương thức giao hàng.',
        'name.string' => 'Tên phương thức phải là chuỗi.',
        'name.max' => 'Tên phương thức không được vượt quá 100 ký tự.',

        'description.string' => 'Mô tả phải là chuỗi.',

        'cost.required' => 'Vui lòng nhập chi phí giao hàng.',
        'cost.numeric' => 'Chi phí phải là một số.',
        'cost.min' => 'Chi phí không được nhỏ hơn 0.',
    ]);

    ShippingMethod::create($request->all());

    return redirect()->route('admin.shipping_methods.index')
        ->with('success', 'Đã thêm phương thức giao hàng!');
}


    public function destroy($id)
    {
        $method = ShippingMethod::findOrFail($id);
        $method->delete();

        return redirect()->back()->with('success', 'Đã xóa phương thức giao hàng');
    }
    public function deactivate($id)
    {
        $method = ShippingMethod::findOrFail($id);
        $method->is_active = false;
        $method->save();

        return redirect()->back()->with('success', 'Đã ẩn phương thức giao hàng');
    }

    public function activate($id)
    {
        $method = ShippingMethod::findOrFail($id);
        $method->is_active = true;
        $method->save();

        return redirect()->back()->with('success', 'Đã kích hoạt phương thức giao hàng');
    }

    public function edit($id)
    {
        $method = ShippingMethod::findOrFail($id);
        return view('admin.shipping_method.edit', compact('method'));
    }

    public function update(Request $request, $id)
    {
        $method = ShippingMethod::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:100|unique:shipping_methods,name,',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
        ], [
            'name.unique' => 'Tên phương thức giao hàng đã tồn tại.',
            'name.required' => 'Vui lòng nhập tên phương thức giao hàng.',
            'name.string' => 'Tên phương thức phải là chuỗi.',
            'name.max' => 'Tên phương thức không được vượt quá 100 ký tự.',
            'description.string' => 'Mô tả phải là chuỗi.',
            'cost.required' => 'Vui lòng nhập chi phí giao hàng.',
            'cost.numeric' => 'Chi phí phải là một số.',
            'cost.min' => 'Chi phí không được nhỏ hơn 0.',
        ]);
        $method->update($request->all());
        return redirect()->route('admin.shipping_methods.index')
            ->with('success', 'Cập nhật phương thức giao hàng thành công!');
    }


}
