<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent', 'children')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?: \Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::withCount(['children', 'products'])->findOrFail($id);

        if ($category->children_count > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Không thể xóa: Danh mục này đang có danh mục con!');
        }

        if ($category->products_count > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Không thể xóa: Danh mục này đang có sản phẩm!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công!');
    }
}
