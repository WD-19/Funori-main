<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PageController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Page::with('author')->orderByDesc('created_at');

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo loại trang
        if ($request->filled('page_type')) {
            $query->where('page_type', $request->page_type);
        }

        // Tìm kiếm theo tiêu đề
        if ($request->has('q') && $request->q) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        // Lấy danh sách loại trang để render filter
        $pageTypes = Page::select('page_type')->distinct()->pluck('page_type');

        $pages = $query->paginate(10)->withQueryString();
        return view('admin.pages.index', compact('pages', 'pageTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = User::all();
        return view('admin.pages.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'content' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'page_type' => 'required|string|max:100',
            'status' => 'required|in:draft,published',
            'featured_image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'published_at' => 'required|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image_url')) {
            $imagePath = $request->file('featured_image_url')->store('uploads/pages', 'public');
        }

        Page::create([
            'title' => $request->title,
            'slug' => $request->slug ?: Str::slug($request->title),
            'content' => $request->content,
            'author_id' => $request->author_id,
            'page_type' => $request->page_type,
            'status' => $request->status,
            'featured_image_url' => $imagePath,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Tạo trang thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $page = Page::with('author')->findOrFail($id);
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $authors = User::all();
        return view('admin.pages.edit', compact('page', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'page_type' => 'required|string|max:100',
            'status' => 'required|in:draft,published',
            'featured_image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = $page->featured_image_url;
        if ($request->hasFile('featured_image_url')) {
            // Xóa ảnh cũ nếu có
            if ($page->featured_image_url && Storage::disk('public')->exists($page->featured_image_url)) {
                Storage::disk('public')->delete($page->featured_image_url);
            }
            $imagePath = $request->file('featured_image_url')->store('uploads/pages', 'public');
        }

        $page->update([
            'title' => $request->title,
            'slug' => $request->slug ?: Str::slug($request->title),
            'content' => $request->content,
            'author_id' => $request->author_id,
            'page_type' => $request->page_type,
            'status' => $request->status,
            'featured_image_url' => $imagePath,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('admin.pages.edit', $page->id)->with('success', 'Cập nhật trang thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        if ($page->featured_image_url && Storage::disk('public')->exists($page->featured_image_url)) {
            Storage::disk('public')->delete($page->featured_image_url);
        }
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Xóa trang thành công!');
    }

    /**
     * Upload image for the editor.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('uploads/pages', 'public');
            $url = asset('storage/' . $path);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $file->getClientOriginalName(),
                'url' => $url
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'No file uploaded or invalid file.']
        ], 400);
    }
}
