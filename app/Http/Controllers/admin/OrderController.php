<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController
{
    // (1) index: danh sách đơn hàng
    public function index(Request $request)
    {
        // Khởi tạo query builder cho model Order
        $query = Order::query();

        // Lọc theo trạng thái đơn hàng nếu có truyền vào
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        // Lọc theo mã đơn hàng hoặc tên khách hàng nếu có truyền vào
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('order_code', 'like', "%{$q}%")
                    ->orWhere('customer_name', 'like', "%{$q}%");
            });
        }

        // Lọc theo tên sản phẩm nếu có truyền vào
        if ($request->filled('product')) {
            $product = $request->product;
            $query->whereHas('items.product', function ($q) use ($product) {
                $q->where('name', 'like', "%{$product}%");
            });
        }

        // Lấy danh sách đơn hàng, sắp xếp mới nhất lên đầu, phân trang 20 bản ghi/trang
        $orders = $query->orderByDesc('created_at')
            ->paginate(20)
            ->appends($request->only(['status', 'q', 'product']));

        // Trả về view danh sách đơn hàng
        return view('admin.orders.index', compact(
            'orders'
        ));
    }

    // Xuất file Excel/CSV
    public function export(Request $request)
    {
        // Khởi tạo query builder cho model Order
        $query = Order::query();

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        // Lọc theo mã đơn hàng hoặc tên khách hàng
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('order_code', 'like', "%{$q}%")
                    ->orWhere('customer_name', 'like', "%{$q}%");
            });
        }

        // Lọc theo tên sản phẩm
        if ($request->filled('product')) {
            $product = $request->product;
            $query->whereHas('items.product', function ($q) use ($product) {
                $q->where('name', 'like', "%{$product}%");
            });
        }

        // Lấy tất cả đơn hàng phù hợp
        $orders = $query->orderByDesc('created_at')->get();

        // Định nghĩa header cho file CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="orders_export_' . now()->format('Ymd_His') . '.csv"',
        ];

        // Định nghĩa các cột cho file CSV
        $columns = [
            'Mã đơn',
            'Khách hàng',
            'Email',
            'SĐT',
            'Tổng tiền',
            'Trạng thái',
            'Ngày đặt',
            'Sản phẩm'
        ];

        // Callback để ghi dữ liệu ra file CSV
        $callback = function() use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                // Lấy tên các sản phẩm trong đơn hàng
                $productNames = $order->items->pluck('product.name')->implode('; ');
                fputcsv($file, [
                    $order->order_code,
                    $order->customer_name,
                    $order->customer_email,
                    $order->customer_phone,
                    $order->total_amount,
                    $order->order_status,
                    $order->ordered_at,
                    $productNames,
                ]);
            }
            fclose($file);
        };

        // Trả về response dạng stream để tải file về
        return response()->stream($callback, 200, $headers);
    }

    // (2) show: xem chi tiết đơn hàng
    public function show($id)
    {
        // Lấy đơn hàng theo id, kèm các quan hệ liên quan
        $order = Order::with(['paymentMethod', 'shippingMethod', 'user', 'items.product'])
                      ->findOrFail($id);
        // Trả về view chi tiết đơn hàng
        return view('admin.orders.show', compact('order'));
    }

    // (3) edit: hiển thị form sửa đơn hàng
    public function edit($id)
    {
        // Lấy đơn hàng theo id
        $order = Order::findOrFail($id);
        // Trả về view form chỉnh sửa đơn hàng
        return view('admin.orders.edit', compact('order'));
    }

    // (4) update: lưu thay đổi đơn hàng
    public function update(Request $request, $id)
    {
        // Lấy đơn hàng theo id
        $order = Order::findOrFail($id);

        // Validate dữ liệu đầu vào
        $request->validate([
            'customer_name'      => 'required|string|max:255',
            'customer_email'     => 'required|email|max:255',
            'customer_phone'     => 'required|string|max:20',
            'shipping_address'   => 'required|string',
            'subtotal_amount'    => 'required|numeric|min:0',
            'shipping_fee'       => 'required|numeric|min:0',
            'discount_amount'    => 'nullable|numeric|min:0',
            'tax_amount'         => 'nullable|numeric|min:0',
            'total_amount'       => 'required|numeric|min:0',
            'payment_method_id'  => 'required|exists:payment_methods,id',
            'payment_status'     => 'required|in:pending,paid,failed,refunded',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'order_status'       => 'required|in:pending_confirmation,processing,shipped,delivered,cancelled,returned',
            'customer_note'      => 'nullable|string',
            'admin_note'         => 'nullable|string',
            'ordered_at'         => 'nullable|date',
            'delivered_at'       => 'nullable|date|after_or_equal:ordered_at',
            'cancelled_at'       => 'nullable|date',
            'cancellation_reason' => 'nullable|string',
        ]);

        // Lấy dữ liệu hợp lệ từ request
        $data = $request->only([
            'user_id',
            'customer_name',
            'customer_email',
            'customer_phone',
            'shipping_address',
            'subtotal_amount',
            'shipping_fee',
            'discount_amount',
            'tax_amount',
            'total_amount',
            'payment_method_id',
            'payment_status',
            'shipping_method_id',
            'order_status',
            'customer_note',
            'admin_note',
            'ordered_at',
            'delivered_at',
            'cancelled_at',
            'cancellation_reason',
        ]);

        // Cập nhật đơn hàng
        $order->update($data);

        // Chuyển hướng về danh sách đơn hàng kèm thông báo thành công
        return redirect()->route('admin.orders.index')
            ->with('success', 'Cập nhật đơn hàng thành công.');
    }

    // (5) destroy: xóa đơn hàng
    public function destroy($id)
    {
        // Lấy đơn hàng theo id
        $order = Order::findOrFail($id);
        // Xóa đơn hàng
        $order->delete();
        // Chuyển hướng về danh sách đơn hàng kèm thông báo thành công
        return redirect()->route('admin.orders.index')
            ->with('success', 'Xóa đơn hàng thành công.');
    }

    /**
     * (6) updateStatus: Xử lý POST cập nhật riêng order_status
     *
     * - Nếu chuyển sang 'delivered' thì set delivered_at = now()
     * - Nếu chuyển sang 'cancelled' thì set cancelled_at = now() và có thể lấy cancellation_reason
     */
    public function updateStatus(Request $request, $id)
    {
        // Lấy đơn hàng theo id
        $order = Order::findOrFail($id);

        // Validate dữ liệu đầu vào
        $request->validate([
            'order_status'        => 'required|in:pending_confirmation,processing,shipped,delivered,cancelled,returned',
            'admin_note'          => 'nullable|string',
            'cancellation_reason' => 'nullable|string|max:500',
        ]);

        $oldStatus = $order->order_status;
        $newStatus = $request->input('order_status');

        // Kiểm tra trạng thái chuyển tiếp hợp lệ
        $transitions = Order::getAllowedStatusTransitions();
        if (!in_array($newStatus, $transitions[$oldStatus] ?? [])) {
            return redirect()->route('admin.orders.tracking', $order->id)
                ->with('error', 'Không thể chuyển trạng thái từ ' . $oldStatus . ' sang ' . $newStatus . '.');
        }

        // Gán trạng thái mới cho đơn hàng
        $order->order_status = $newStatus;

        // Cập nhật các mốc thời gian tương ứng nếu trạng thái thay đổi
        if ($oldStatus !== $newStatus) {
            if ($newStatus === 'processing' && !$order->processing_at) {
                $order->processing_at = now();
            }
            if ($newStatus === 'shipped' && !$order->shipped_at) {
                $order->shipped_at = now();
            }
            if ($newStatus === 'delivered' && !$order->delivered_at) {
                $order->delivered_at = now();
            }
            if ($newStatus === 'cancelled' && !$order->cancelled_at) {
                $order->cancelled_at = now();
                if ($request->filled('cancellation_reason')) {
                    $order->cancellation_reason = $request->input('cancellation_reason');
                }
            }
            if ($newStatus === 'returned' && !$order->returned_at) {
                $order->returned_at = now();
            }
        }

        // Cập nhật ghi chú admin nếu có
        if ($request->filled('admin_note')) {
            $order->admin_note = $request->input('admin_note');
        }

        // Lưu đơn hàng
        $order->save();

        // Chuyển hướng về trang tracking trạng thái đơn hàng kèm thông báo thành công
        return redirect()
            ->route('admin.orders.tracking', $order->id)
            ->with('success', 'Cập nhật trạng thái thành công.');
    }

    // (6.1) tracking: hiển thị form cập nhật trạng thái riêng
    public function tracking($id)
    {
        // Lấy đơn hàng theo id
        $order = Order::findOrFail($id);
        // Trả về view tracking trạng thái đơn hàng
        return view('admin.orders.tracking', compact('order'));
    }

    // (7) processCancel: xử lý yêu cầu hủy từ khách
    public function processCancel(Request $request, $id)
    {
        // Lấy đơn hàng kèm sản phẩm
        $order = Order::with('items.product')->findOrFail($id);

        // Chỉ cho phép hủy khi trạng thái là chờ xác nhận, đang xử lý, hoặc chờ hủy
        $canCancelStatuses = ['pending_confirmation', 'processing', 'pending_cancellation'];
        if (!in_array($order->order_status, $canCancelStatuses)) {
            // Nếu đã giao, đang giao, đã trả hàng, đã hủy thì không cho phép hủy
            if ($order->order_status === 'delivered') {
                return redirect()->back()->with('error', 'Đơn hàng đã giao không thể hủy, chỉ có thể hoàn trả.');
            }
            if ($order->order_status === 'shipped') {
                return redirect()->back()->with('error', 'Đơn hàng đang giao không thể hủy.');
            }
            if ($order->order_status === 'returned') {
                return redirect()->back()->with('error', 'Đơn hàng đã trả hàng không thể hủy.');
            }
            if ($order->order_status === 'cancelled') {
                return redirect()->back()->with('error', 'Đơn hàng đã bị hủy.');
            }
            // Trạng thái khác cũng không cho phép hủy
            return redirect()->back()->with('error', 'Chỉ có thể hủy đơn khi đơn hàng đang ở trạng thái chờ xác nhận hoặc đang xử lý.');
        }

        // Lấy action (approve/reject), ghi chú admin và lý do hủy từ request
        $action = $request->input('action');
        $adminNote = $request->input('admin_note_cancel');
        $cancelReason = $request->input('cancellation_reason');

        if ($action === 'approve') {
            // Đảm bảo chỉ hủy khi trạng thái hiện tại vẫn là chờ xác nhận, đang xử lý, hoặc chờ hủy
            if (!in_array($order->order_status, ['pending_confirmation', 'processing', 'pending_cancellation'])) {
                return redirect()->back()->with('error', 'Trạng thái đơn hàng đã thay đổi, không thể hủy.');
            }
            // Đổi trạng thái thành đã hủy, cập nhật thời gian và lý do
            $order->order_status = 'cancelled';
            $order->cancelled_at = now();
            $order->admin_note = $adminNote;
            $order->cancellation_reason = $cancelReason;

            // Trả lại số lượng tồn kho cho từng sản phẩm trong đơn hàng
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->quantity);
                }
            }

            // Lưu đơn hàng
            $order->save();

            // Chuyển hướng về danh sách đơn hàng kèm thông báo thành công
            return redirect()->route('admin.orders.index')
                ->with('success', 'Đã duyệt hủy đơn #' . $order->order_code);
        }

        if ($action === 'reject') {
            // Trả về trạng thái trước khi pending_cancellation (nếu có)
            $order->order_status = $order->previous_status ?? 'processing';
            $order->admin_note = $adminNote;
            $order->save();

            // Chuyển hướng về danh sách đơn hàng kèm thông báo thành công
            return redirect()->route('admin.orders.index')
                ->with('success', 'Đã từ chối yêu cầu hủy đơn #' . $order->order_code);
        }

        // Nếu action không hợp lệ
        return redirect()->back()->with('error', 'Thao tác không hợp lệ.');
    }

    // (8) printInvoice: hiển thị view HTML/Hóa đơn
    public function printInvoice($id)
    {
        // Lấy đơn hàng kèm các quan hệ liên quan
        $order = Order::with(['items.product', 'paymentMethod', 'shippingMethod', 'user'])
                      ->findOrFail($id);
        // Trả về view hóa đơn
        return view('admin.orders.print_invoice', compact('order'));
    }

    // (9) printShipping: hiển thị view HTML/Phiếu giao hàng
    public function printShipping($id)
    {
        // Lấy đơn hàng kèm các quan hệ liên quan
        $order = Order::with(['items.product', 'paymentMethod', 'shippingMethod', 'user'])
                      ->findOrFail($id);
        // Trả về view phiếu giao hàng
        return view('admin.orders.print_shipping', compact('order'));
    }

    // (10) stats: thống kê đơn hàng
    public function stats(Request $request)
    {
        // Đếm tổng số đơn hàng
        $totalOrders = Order::count();
        // Đếm số đơn đã giao
        $deliveredOrders = Order::where('order_status', 'delivered')->count();
        // Đếm số đơn đã hủy
        $cancelledOrders = Order::where('order_status', 'cancelled')->count();
        // Đếm số đơn đang xử lý
        $processingOrders = Order::where('order_status', 'processing')->count();
        // Đếm số đơn chờ xác nhận
        $pendingOrders = Order::where('order_status', 'pending_confirmation')->count();
        // Đếm số đơn đã trả hàng
        $returnedOrders = Order::where('order_status', 'returned')->count();

        // Tính tổng doanh thu tháng hiện tại (chỉ đơn đã giao)
        $totalRevenueMonth = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('order_status', 'delivered')
            ->sum('total_amount');
        // Tính tổng doanh thu năm hiện tại (chỉ đơn đã giao)
        $totalRevenueYear = Order::whereYear('created_at', now()->year)
            ->where('order_status', 'delivered')
            ->sum('total_amount');
        // Tính doanh thu trung bình mỗi tháng trong năm
        $avgRevenuePerMonth = $totalRevenueYear / (now()->month ?: 1);

        // Lấy đơn hàng mới nhất
        $latestOrder = Order::orderByDesc('created_at')->first();

        // Chuẩn bị dữ liệu cho biểu đồ: Đơn hàng và doanh thu theo tháng trong năm
        $chartLabels = [];
        $chartOrderCounts = [];
        $chartOrderAmounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartLabels[] = sprintf('%02d/%s', $m, now()->year);
            $chartOrderCounts[] = Order::whereMonth('created_at', $m)
                ->whereYear('created_at', now()->year)
                ->count();
            $chartOrderAmounts[] = Order::whereMonth('created_at', $m)
                ->whereYear('created_at', now()->year)
                ->where('order_status', 'delivered')
                ->sum('total_amount');
        }

        // Trả về view thống kê đơn hàng
        return view('admin.orders.stats', compact(
            'totalOrders',
            'deliveredOrders',
            'cancelledOrders',
            'processingOrders',
            'pendingOrders',
            'returnedOrders',
            'totalRevenueMonth',
            'totalRevenueYear',
            'avgRevenuePerMonth',
            'latestOrder',
            'chartLabels',
            'chartOrderCounts',
            'chartOrderAmounts'
        ));
    }
}
