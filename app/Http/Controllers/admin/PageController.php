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
        $authors = User::where('role', 'admin')->get();
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
            'featured_image_url' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'published_at' => 'required|date|before_or_equal:now',
        ], [
            'title.required' => 'Tiêu đề trang là bắt buộc.',
            'title.string' => 'Tiêu đề trang phải là chuỗi ký tự.',
            'title.max' => 'Tiêu đề trang không được vượt quá 255 ký tự.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác.',
            'content.required' => 'Nội dung là bắt buộc.',
            'content.string' => 'Nội dung phải là chuỗi ký tự.',
            'author_id.required' => 'Tác giả là bắt buộc.',
            'author_id.exists' => 'Tác giả không tồn tại.',
            'page_type.required' => 'Loại trang là bắt buộc.',
            'page_type.string' => 'Loại trang phải là chuỗi ký tự.',
            'page_type.max' => 'Loại trang không được vượt quá 100 ký tự.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'featured_image_url.required' => 'Ảnh đại diện là bắt buộc.',
            'featured_image_url.image' => 'Tệp phải là hình ảnh.',
            'featured_image_url.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png.',
            'featured_image_url.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'meta_title.required' => 'Meta title là bắt buộc.',
            'meta_title.string' => 'Meta title phải là chuỗi ký tự.',
            'meta_title.max' => 'Meta title không được vượt quá 255 ký tự.',
            'meta_description.required' => 'Meta description là bắt buộc.',
            'meta_description.string' => 'Meta description phải là chuỗi ký tự.',
            'meta_description.max' => 'Meta description không được vượt quá 500 ký tự.',
            'published_at.required' => 'Ngày xuất bản là bắt buộc.',
            'published_at.date' => 'Ngày xuất bản phải là ngày hợp lệ.',
            'published_at.before_or_equal' => 'Ngày xuất bản không được vượt quá thời điểm hiện tại.',
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image_url')) {
            $imagePath = $request->file('featured_image_url')->store('pages', 'public');
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
        // Chỉ lấy các user là admin
        $authors = User::where('role', 'admin')->get();
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
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'published_at' => 'required|date|before_or_equal:now',
        ], [
            'title.required' => 'Tiêu đề trang là bắt buộc.',
            'title.string' => 'Tiêu đề trang phải là chuỗi ký tự.',
            'title.max' => 'Tiêu đề trang không được vượt quá 255 ký tự.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác.',
            'content.required' => 'Nội dung là bắt buộc.',
            'content.string' => 'Nội dung phải là chuỗi ký tự.',
            'author_id.required' => 'Tác giả là bắt buộc.',
            'author_id.exists' => 'Tác giả không tồn tại.',
            'page_type.required' => 'Loại trang là bắt buộc.',
            'page_type.string' => 'Loại trang phải là chuỗi ký tự.',
            'page_type.max' => 'Loại trang không được vượt quá 100 ký tự.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'featured_image_url.image' => 'Tệp phải là hình ảnh.',
            'featured_image_url.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png.',
            'featured_image_url.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'meta_title.required' => 'Meta title là bắt buộc.',
            'meta_title.string' => 'Meta title phải là chuỗi ký tự.',
            'meta_title.max' => 'Meta title không được vượt quá 255 ký tự.',
            'meta_description.required' => 'Meta description là bắt buộc.',
            'meta_description.string' => 'Meta description phải là chuỗi ký tự.',
            'meta_description.max' => 'Meta description không được vượt quá 500 ký tự.',
            'published_at.required' => 'Ngày xuất bản là bắt buộc.',
            'published_at.date' => 'Ngày xuất bản phải là ngày hợp lệ.',
            'published_at.before_or_equal' => 'Ngày xuất bản không được vượt quá thời điểm hiện tại.',
        ]);

        $imagePath = $page->featured_image_url;
        if ($request->hasFile('featured_image_url')) {
            // Xóa ảnh cũ nếu có
            if ($page->featured_image_url && Storage::disk('public')->exists($page->featured_image_url)) {
                Storage::disk('public')->delete($page->featured_image_url);
            }
            $imagePath = $request->file('featured_image_url')->store('pages', 'public');
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

        return redirect()->route('admin.pages.index', $page->id)->with('success', 'Cập nhật trang thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        // Xóa ảnh đại diện nếu có
        if ($page->featured_image_url && Storage::disk('public')->exists($page->featured_image_url)) {
            Storage::disk('public')->delete($page->featured_image_url);
        }

        // Xóa các ảnh trong nội dung (content)
        if ($page->content) {
            // Tìm tất cả các đường dẫn ảnh trong content (giả sử đường dẫn là /storage/pages/filename.jpg)
            preg_match_all('/<img[^>]+src=["\'](.*?)["\']/i', $page->content, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $imageUrl) {
                    // Lấy phần path từ URL (bỏ phần domain nếu có)
                    $path = parse_url($imageUrl, PHP_URL_PATH);
                    if ($path && strpos($path, '/storage/pages/') === 0) {
                        $storagePath = str_replace('/storage/pages/', 'pages/', $path);
                        if (Storage::disk('public')->exists($storagePath)) {
                            Storage::disk('public')->delete($storagePath);
                        }
                    }
                }
            }
        }

        // Xóa bài viết
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Xóa trang thành công!');
    }

    /**
     * Upload image for the editor.
     */
    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
            ], [
                'file.required' => 'Tệp ảnh là bắt buộc.',
                'file.image' => 'Tệp phải là hình ảnh.',
                'file.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png, gif.',
                'file.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('pages', 'public'); // Lưu vào storage/app/public/pages
                $url = Storage::disk('public')->url($path); // Tạo URL công khai
                // Kiểm tra file tồn tại
                if (Storage::disk('public')->exists($path)) {
                    return response()->json(['location' => $url]);
                }
                return response()->json(['error' => 'Không thể lưu file'], 500);
            }
            return response()->json(['error' => 'Không có file được tải lên'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Tải file thất bại: ' . $e->getMessage()], 500);
        }
    }
}
