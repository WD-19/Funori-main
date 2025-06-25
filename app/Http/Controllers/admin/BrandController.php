<?php
namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController 
{
    public function index()
    {
       $brands = Brand::orderBy('created_at', 'desc')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:brands,name',
        'description' => 'nullable|string',
        'logo' => 'nullable|image|max:2048', // giới hạn 2MB
    ]);

    // Sinh slug
    $validated['slug'] = Str::slug($validated['name']);

    // Xử lý logo nếu có
    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('logos', 'public');
        $validated['logo_url'] = $path; 
    }

    Brand::create($validated);

    return redirect()->route('admin.brands.index')->with('success', 'Thêm thương hiệu thành công!');
}

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:brands,name,' . $brand->id,
            'slug' => 'nullable|max:255|unique:brands,slug,' . $brand->id,
            'logo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo_url'] = $path;
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', 'Cập nhật thương hiệu thành công!');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Xóa thương hiệu thành công!');
    }

    public function toggle(Brand $brand)
    {
        $brand->is_active = !$brand->is_active;
        $brand->save();
        return redirect()->route('admin.brands.index')->with('success', 'Trạng thái thương hiệu đã được cập nhật!');
    }
}
