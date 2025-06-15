<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Category::query();

        // Lọc theo trạng thái
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // Tìm kiếm theo tên (loại bỏ dấu cách)
        $name = trim($request->input('name', ''));

        // Nếu KHÔNG lọc trạng thái và KHÔNG tìm kiếm (rỗng hoặc chỉ dấu cách)
        if (!$request->filled('is_active') && $name === '') {
            // Hiển thị index ban đầu: chỉ lấy danh mục cha, eager load children
            $query->whereNull('parent_id')
                ->with(['children'])
                ->orderBy('created_at', 'desc');
            $categories = $query->paginate(10)->withQueryString();
            $isSearching = false;
        } else {
            // Có lọc trạng thái hoặc tìm kiếm: hiển thị danh sách phẳng
            if ($name !== '') {
                $query->where('name', 'like', '%' . $name . '%');
            }
            $query->orderBy('created_at', 'desc');
            $categories = $query->paginate(10)->withQueryString();
            $isSearching = true;
        }

        return view('admin.categories.index', compact('categories', 'isSearching'));
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
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image_url' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('uploads/categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'image_url' => $imagePath,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::with('parent', 'children', 'products')->findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::whereNull('parent_id')->where('id', '!=', $id)->get();
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::withCount('children')->findOrFail($id);

        $isParentWithChildren = is_null($category->parent_id) && $category->children_count > 0;

        // Nếu là danh mục cha và đang có danh mục con thì không cho cập nhật parent_id
        if ($isParentWithChildren) {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
                'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
                'description' => 'nullable|string',
                'image_url' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'is_active' => 'required|boolean',
            ]);

            // Nếu người dùng cố tình thay đổi parent_id
            if ($request->parent_id && $request->parent_id != $category->parent_id) {
                return redirect()->back()
                    // KHÔNG dùng withInput()
                    ->with('error', 'Không thể thay đổi danh mục cha vì danh mục này đang chứa danh mục con!');
            }
        } else {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
                'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
                'parent_id' => 'nullable|exists:categories,id|not_in:' . $category->id,
                'description' => 'nullable|string',
                'image_url' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'is_active' => 'required|boolean',
            ]);
        }

        $imagePath = $category->image_url;

        if ($request->hasFile('image_url')) {
            // Xóa ảnh cũ nếu có
            if ($category->image_url && Storage::disk('public')->exists($category->image_url)) {
                Storage::disk('public')->delete($category->image_url);
            }
            // Lưu ảnh mới
            $imagePath = $request->file('image_url')->store('uploads/categories', 'public');
        }

        $updateData = [
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
            'description' => $request->description,
            'image_url' => $imagePath,
            'is_active' => $request->is_active,
        ];

        // Chỉ cập nhật parent_id nếu được phép
        if (!$isParentWithChildren) {
            $updateData['parent_id'] = $request->parent_id;
        }

        $category->update($updateData);

        return redirect()->route('admin.categories.edit', $category->id)
            ->with('success', 'Cập nhật danh mục thành công!');
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

        // Xóa file ảnh nếu có
        if ($category->image_url && Storage::disk('public')->exists($category->image_url)) {
            Storage::disk('public')->delete($category->image_url);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công!');
    }
}
