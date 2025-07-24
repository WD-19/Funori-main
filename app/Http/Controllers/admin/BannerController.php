<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController
{
    // Trang danh sách banner
    public function index(Request $request)
    {
        $query = Banner::query();

        // Nếu có lọc theo vị trí (position)
        if ($request->filled('position')) $query->where('position', $request->position);

        // Nếu có lọc theo trạng thái (is_active)
        if ($request->filled('is_active')) $query->where('is_active', $request->is_active);

        // Lấy danh sách banner theo thứ tự 'order'
        $banners = $query->orderBy('order')->get();

        // Lấy tất cả các vị trí khác nhau (dùng cho filter hoặc select box)
        $positions = Banner::distinct()->pluck('position');

        // Trả về view danh sách, truyền dữ liệu
        return view('admin.banners.index', compact('banners', 'positions'));
    }

    // Trang hiển thị form tạo banner mới
    public function create()
    {
        // Lấy các vị trí hiện có (để chọn vị trí khi tạo banner)
        $positions = Banner::distinct()->pluck('position');
        return view('admin.banners.create', compact('positions'));
    }

    // Xử lý lưu banner mới vào CSDL
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image',
            'position' => 'required|string|max:50',
            'is_active' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'link_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'image.required' => 'Ảnh banner là bắt buộc.',
            'image.image' => 'Tệp phải là hình ảnh.',
            'position.required' => 'Vị trí là bắt buộc.',
            'position.string' => 'Vị trí phải là chuỗi ký tự.',
            'position.max' => 'Vị trí không được vượt quá 50 ký tự.',
            'start_at.date' => 'Thời gian bắt đầu phải là ngày hợp lệ.',
            'end_at.date' => 'Thời gian kết thúc phải là ngày hợp lệ.',
            'end_at.after_or_equal' => 'Thời gian kết thúc phải sau hoặc bằng thời gian bắt đầu.',
            'link.string' => 'Link phải là chuỗi ký tự.',
            'link.max' => 'Link không được vượt quá 255 ký tự.',
            'order.integer' => 'Thứ tự phải là số nguyên.',
        ]);

        // Lưu ảnh vào thư mục public/storage/banners
        $data['image_url'] = $request->file('image')->store('banners', 'public');

        // Gán thứ tự cho banner mới (cuối danh sách nếu không nhập)
        $data['order'] = $data['order'] ?? (Banner::max('order') + 1);

        // Xử lý trường is_active checkbox (nếu không check sẽ không có trong $data)
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Tạo banner
        Banner::create($data);

        // Redirect về trang danh sách với thông báo
        return redirect()->route('admin.banners.index')->with('success', 'Tạo banner thành công');
    }

    // Trang chi tiết banner
    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    // Trang chỉnh sửa banner
    public function edit(Banner $banner)
    {
        // Lấy danh sách vị trí để chọn lại nếu cần
        $positions = Banner::distinct()->pluck('position');
        return view('admin.banners.edit', compact('banner', 'positions'));
    }

    // Xử lý cập nhật banner
    public function update(Request $request, Banner $banner)
    {
        // Validate dữ liệu
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image', // Ảnh có thể không đổi
            'position' => 'required|string|max:50',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'link_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'cropped_image' => 'nullable|string',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'image.image' => 'Tệp phải là hình ảnh.',
            'position.required' => 'Vị trí là bắt buộc.',
            'position.string' => 'Vị trí phải là chuỗi ký tự.',
            'position.max' => 'Vị trí không được vượt quá 50 ký tự.',
            'start_at.date' => 'Thời gian bắt đầu phải là ngày hợp lệ.',
            'end_at.date' => 'Thời gian kết thúc phải là ngày hợp lệ.',
            'end_at.after_or_equal' => 'Thời gian kết thúc phải sau hoặc bằng thời gian bắt đầu.',
            'link.string' => 'Link phải là chuỗi ký tự.',
            'link.max' => 'Link không được vượt quá 255 ký tự.',
            'order.integer' => 'Thứ tự phải là số nguyên.',
        ]);

        if ($request->filled('cropped_image')) {
            $cropped = $request->input('cropped_image');
            $cropped = preg_replace('#^data:image/\w+;base64,#i', '', $cropped);
            $cropped = base64_decode($cropped);
            $filename = 'banners/' . uniqid('banner_') . '.jpg';
            Storage::disk('public')->put($filename, $cropped);
            $data['image_url'] = $filename;
        } elseif ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('banners', 'public');
        }

        // Cập nhật dữ liệu banner
        $banner->update($data);

        // Quay lại danh sách với thông báo
        return redirect()->route('admin.banners.index')->with('success', 'Cập nhật banner thành công');
    }

    // Xóa banner
    public function destroy(Banner $banner)
    {
        $banner->delete(); // Xóa khỏi CSDL
        return back()->with('success', 'Đã xóa banner');
    }

    // Cập nhật thứ tự hiển thị các banner (drag-drop, re-order)
    public function reorder(Request $request)
    {
        // Duyệt qua danh sách ID và cập nhật thứ tự mới
        foreach ($request->order as $idx => $id) {
            Banner::where('id', $id)->update(['order' => $idx + 1]);
        }
        return back()->with('success', 'Đã cập nhật thứ tự');
    }

    // Bật/tắt trạng thái hiển thị của banner (ẩn/hiện)
    public function toggle(Banner $banner)
    {
        $banner->is_active = !$banner->is_active; // Đảo trạng thái
        $banner->save();
        return back()->with('success', 'Đã cập nhật trạng thái banner!');
    }
}