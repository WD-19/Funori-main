<?php

namespace App\Http\Controllers\client;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController 
{
   public function getApplicableVouchers(Request $request)
{
    if (!Auth::check()) {
        return response('<p class="p-3 text-center text-muted">Bạn cần đăng nhập để xem voucher.</p>');
    }

    $user = Auth::user();

    // ✅ Chỉ lọc theo trạng thái và thời gian
    $vouchers = Promotion::where('is_active', 1)
        ->where(function ($q) {
            $q->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->get();

    if ($vouchers->isEmpty()) {
        return response('<p class="p-3 text-center">Không có voucher nào đang hoạt động.</p>');
    }

    $html = '';
    foreach ($vouchers as $voucher) {
        $discountText = $voucher->discount_type == 'percentage'
            ? "Giảm {$voucher->discount_value}%"
            : "Giảm " . number_format($voucher->discount_value) . "đ";

        $limitText = $voucher->usage_limit_per_user
            ? " (Tối đa {$voucher->usage_limit_per_user} lượt dùng)"
            : "";

        $html .= '
        <div class="p-3 border-bottom">
            <strong>' . $voucher->code . '</strong> - ' . $discountText . $limitText . '
            <br><small>' . htmlspecialchars($voucher->description ?? '') . '</small>
            <button type="button" 
                    class="apply-voucher-btn btn btn-sm btn-primary mt-2"
                    data-code="' . $voucher->code . '">
                Áp dụng
            </button>
        </div>';
    }

    return response($html);
}
}