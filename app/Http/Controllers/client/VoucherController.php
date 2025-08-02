<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController 
{
    /**
     * Lấy danh sách các voucher hợp lệ cho người dùng hiện tại.
     * Trả về một partial view để hiển thị trong modal.
     */
    public function getApplicableVouchers(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để xem voucher'], 401);
        }

        $user = Auth::user();

        // Lấy ID các voucher đã sử dụng
        $usedVoucherIds = $user->orders()->whereHas('promotions')->with('promotions')->get()
            ->flatMap(function ($order) {
                return $order->promotions->pluck('id');
            })
            ->unique()
            ->toArray();

        // Lấy các voucher còn hiệu lực và chưa được sử dụng
        $vouchers = Promotion::with('brands', 'categories')
            ->where('is_active', 1)
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->whereNotIn('id', $usedVoucherIds)
            ->get();

        // Trả về một view partial chứa danh sách voucher
        return view('client.cart.partials.voucher_list', compact('vouchers'));
    }
}