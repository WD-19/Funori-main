<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;

class PageController
{
    /**
     * Display the page.
     */
    public function index(Request $request)
    {
        // Xử lý logic để lấy dữ liệu cần thiết cho trang
        // Ví dụ: lấy thông tin người dùng, bài viết, v.v.

        return view('client.page.page'); // Trả về view tương ứng
    }
}
