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
        $query = Order::query();

        // Lọc theo trạng thái đơn hàng nếu có truyền vào
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($subQuery) use ($q) {
                $subQuery->where('order_code', 'like', "%{$q}%")
                    ->orWhere('buyer_name', 'like', "%{$q}%")
                    ->orWhere('shipping_name', 'like', "%{$q}%")
                    ->orWhere('customer_phone', 'like', "%{$q}%")
                    ->orWhere('buyer_phone', 'like', "%{$q}%")
                    ->orWhere('shipping_phone', 'like', "%{$q}%");
            });
        }

        // Sửa lại logic lọc phương thức thanh toán
        if ($request->filled('payment_method_id')) {
            $query->where(function ($q2) use ($request) {
                $q2->where('payment_method_id', $request->payment_method_id);
            });
        }

        // Sửa lại logic lọc phương thức vận chuyển
        if ($request->filled('shipping_method_id')) {
            $query->where(function ($q2) use ($request) {
                $q2->where('shipping_method_id', $request->shipping_method_id);
            });
        }

        // Lọc theo ngày tạo
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        // Lọc theo khoảng thời gian đã giao hàng
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->start_date));
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->end_date));
        }
        //
        // Lấy danh sách đơn hàng, sắp xếp mới nhất lên đầu, phân trang 20 bản ghi/trang
        $orders = $query->with(['shipper', 'paymentMethod', 'shippingMethod'])
            ->orderByDesc('created_at')
            ->paginate(20)
            ->appends($request->all());

        return view('admin.orders.index', compact('orders'));
    }

    // Xuất file Excel/CSV
    public function export(Request $request)
    {
        // Khởi tạo query builder cho model Order
        $query = Order::query();

        // Lọc theo trạng thái (giống trang index)
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        // Lọc theo từ khóa chung (giống trang index)
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($subQuery) use ($q) {
                $subQuery->where('order_code', 'like', "%{$q}%")
                    ->orWhere('buyer_name', 'like', "%{$q}%")
                    ->orWhere('shipping_name', 'like', "%{$q}%")
                    ->orWhere('customer_phone', 'like', "%{$q}%")
                    ->orWhere('buyer_phone', 'like', "%{$q}%")
                    ->orWhere('shipping_phone', 'like', "%{$q}%");
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
            'Ma Don',
            'Ten Nguoi Mua',
            'SDT Nguoi Mua',
            'Ten Nguoi Nhan',
            'SDT Nguoi Nhan',
            'Tong Tien',
            'Trang Thai',
            'Ngay Dat',
            'San Pham'
        ];

        // Callback để ghi dữ liệu ra file CSV
        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                // Lấy tên các sản phẩm trong đơn hàng
                $productNames = $order->items->pluck('product.name')->implode('; ');
                fputcsv($file, [
                    $order->order_code, // Mã đơn
                    $order->buyer_name, // Tên người mua
                    $order->buyer_phone, // SĐT người mua
                    $order->shipping_name, // Tên người nhận
                    $order->shipping_phone, // SĐT người nhận
                    $order->total_amount, // Tổng tiền
                    $order->order_status, // Trạng thái
                    $order->created_at->format('Y-m-d H:i:s'), // Ngày đặt
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
        $order = Order::with(['paymentMethod', 'shippingMethod', 'user', 'shipper', 'items.product.images', 'items.productVariant.attributeValues.attribute'])
            ->findOrFail($id);
        // Trả về view chi tiết đơn hàng
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Lấy thông tin delivery cho modal
     */
    public function getDeliveryInfo($id)
    {
        $order = Order::with(['user', 'shipper'])->findOrFail($id);
        
        $deliveryInfo = [
            'order_code' => $order->order_code,
            'received_at' => $order->received_at ? $order->received_at->format('d/m/Y H:i') : null,
            'in_delivery_at' => $order->in_delivery_at ? $order->in_delivery_at->format('d/m/Y H:i') : null,
            'delivered_at' => $order->delivered_at ? $order->delivered_at->format('d/m/Y H:i') : null,
            'failed_at' => $order->failed_at ? $order->failed_at->format('d/m/Y H:i') : null,
            'delivery_notes' => $order->delivery_notes,
            'failure_reason' => $order->failure_reason,
            'delivery_images' => $order->delivery_images,
        ];
        
        return response()->json($deliveryInfo);
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
            // Admin chỉ có quyền chỉnh ở các trạng thái trước giao hàng
            'order_status'       => 'required|in:pending_confirmation,processing,cancelled,returned',
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
            // Chỉ cho phép cập nhật sang trạng thái thuộc quyền Admin
            'order_status'        => 'required|in:pending_confirmation,processing,cancelled,returned',
            'admin_note'          => 'nullable|string',
            'cancellation_reason' => 'nullable|string|max:500',
        ]);

        $oldStatus = $order->order_status;
        $newStatus = $request->input('order_status');
        $adminNote = $request->input('admin_note');

        // Kiểm tra hoàn trả hàng chỉ trong 7 ngày kể từ khi nhận hàng
        if ($oldStatus === 'delivered' && $newStatus === 'returned') {
            if (!$order->delivered_at) {
                return redirect()->back()->with('error', 'Không xác định được ngày giao hàng. Không thể hoàn trả.');
            }
            $now = now();
            $deliveredAt = $order->delivered_at instanceof \Carbon\Carbon ? $order->delivered_at : \Carbon\Carbon::parse($order->delivered_at);
            if ($now->diffInDays($deliveredAt) > 7) {
                return redirect()->back()->with('error', 'Chỉ được hoàn trả hàng trong vòng 7 ngày kể từ khi nhận hàng. Đơn hàng này đã quá hạn hoàn trả.');
            }
        }

        // Cho phép chuyển đổi tự do giữa các trạng thái để test

        // Nếu cố gắng set sang trạng thái của shipper (shipped/delivered) thì chặn
        if (in_array($newStatus, ['shipped', 'delivered'])) {
            return redirect()->back()->with('error', 'Trạng thái này thuộc luồng shipper. Admin chỉ xử lý đến Đang xử lý.');
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
                
                // Trả lại số lượng tồn kho cho từng sản phẩm/biến thể trong đơn hàng
                $this->returnItemsToStock($order);
            }
            if ($newStatus === 'returned' && !$order->returned_at) {
                $order->returned_at = now();
            }
        }

        // Cập nhật ghi chú admin nếu có
        if ($request->filled('admin_note')) {
            $order->admin_note = $adminNote;
        }

        // Lưu đơn hàng
        $order->save();

        // Ghi lại lịch sử trạng thái (bao gồm ghi chú admin) nếu có quan hệ status_histories
        if (method_exists($order, 'status_histories')) {
            // Nếu trạng thái đã tồn tại trong lịch sử, chỉ thêm bản ghi mới nếu trạng thái thực sự thay đổi
            // Nếu trạng thái KHÁC, tạo bản ghi mới
            if ($oldStatus !== $newStatus) {
                $order->status_histories()->create([
                    'status' => $newStatus,
                    'admin_note' => $adminNote,
                    'created_at' => now(),
                ]);
            } else {
                // Nếu trạng thái KHÔNG đổi, chỉ cập nhật ghi chú cho bản ghi cuối cùng (nếu có)
                $lastHistory = $order->status_histories()->latest()->first();
                if ($lastHistory && $lastHistory->status === $newStatus && $request->filled('admin_note')) {
                    $lastHistory->admin_note = $adminNote;
                    $lastHistory->save();
                }
            }
        }

        // Dispatch WebSocket event for realtime updates
        if ($oldStatus !== $newStatus) {
            event(new \App\Events\OrderStatusUpdated($order, $oldStatus, $newStatus, 'admin'));
        }

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

    /**
     * Trả lại sản phẩm về kho khi hủy đơn hàng
     */
    private function returnItemsToStock($order)
    {
        foreach ($order->items as $item) {
            if ($item->product_variant_id) {
                $variant = \App\Models\ProductVariant::find($item->product_variant_id);
                if ($variant) {
                    $variant->increment('stock_quantity', $item->quantity);
                }
            } elseif ($item->product) {
                // Chỉ tăng kho cho sản phẩm gốc nếu không có biến thể
                $item->product->increment('stock_quantity', $item->quantity);
            }
        }
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
            if (!empty($cancelReason)) {
                $order->cancellation_reason = $cancelReason;
            }

            // Trả lại số lượng tồn kho cho từng sản phẩm/biến thể trong đơn hàng
            $this->returnItemsToStock($order);

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
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        // Thời gian
        $startOfThisMonth  = $now->copy()->startOfMonth();
        $endOfThisMonth    = $now->copy()->endOfMonth();
        $startOfLastMonth  = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $endOfLastMonth    = $now->copy()->subMonthNoOverflow()->endOfMonth();
        $startOfLastYearMo = $now->copy()->subYear()->startOfMonth();
        $endOfLastYearMo   = $now->copy()->subYear()->endOfMonth();

        // Tổng số đơn & theo trạng thái
        $totalOrders      = Order::count();
        $deliveredOrders  = Order::where('order_status', 'delivered')->count();
        $cancelledOrders  = Order::where('order_status', 'cancelled')->count();
        $processingOrders = Order::where('order_status', 'processing')->count();
        $pendingOrders    = Order::where('order_status', 'pending_confirmation')->count();
        $returnedOrders   = Order::where('order_status', 'returned')->count();

        // Doanh thu & số đơn delivered tháng này
        $totalRevenueThisMonth = Order::where('order_status', 'delivered')
            ->whereBetween('delivered_at', [$startOfThisMonth, $endOfThisMonth])
            ->sum('total_amount');
        $deliveredThisMonth = Order::where('order_status', 'delivered')
            ->whereBetween('delivered_at', [$startOfThisMonth, $endOfThisMonth])
            ->count();

        // So sánh
        $totalRevenueLastMonth       = Order::where('order_status', 'delivered')
            ->whereBetween('delivered_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('total_amount');
        $totalRevenueThisMonthLastYear = Order::where('order_status', 'delivered')
            ->whereBetween('delivered_at', [$startOfLastYearMo, $endOfLastYearMo])
            ->sum('total_amount');

        // KPI
        $completed = $deliveredOrders + $cancelledOrders;
        $successRate        = $completed ? round($deliveredOrders / $completed * 100, 1) : 0;
        $cancellationRate   = $completed ? round($cancelledOrders / $completed * 100, 1) : 0;
        $averageOrderValue  = $deliveredThisMonth ? round($totalRevenueThisMonth / $deliveredThisMonth) : 0;
        $momRevenueGrowth   = $totalRevenueLastMonth
            ? round(($totalRevenueThisMonth - $totalRevenueLastMonth) / $totalRevenueLastMonth * 100, 1)
            : ($totalRevenueThisMonth ? 100 : 0);
        $yoyRevenueGrowth   = $totalRevenueThisMonthLastYear
            ? round(($totalRevenueThisMonth - $totalRevenueThisMonthLastYear) / $totalRevenueThisMonthLastYear * 100, 1)
            : ($totalRevenueThisMonth ? 100 : 0);

        // Sparkline: 6 tháng gần nhất
        $sparklineLabels = $sparklineData = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = $now->copy()->subMonths($i);
            $sparklineLabels[] = $m->format('M Y');
            $sparklineData[]   = Order::where('order_status', 'delivered')
                ->whereMonth('delivered_at', $m->month)
                ->whereYear('delivered_at', $m->year)
                ->sum('total_amount');
        }

        // Bar/line chart: 12 tháng năm nay
        $chartLabels = $chartCounts = $chartAmounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartLabels[]  = sprintf('%02d/%d', $m, $now->year);
            $chartCounts[]  = Order::whereMonth('created_at', $m)
                ->whereYear('created_at', $now->year)->count();
            $chartAmounts[] = Order::where('order_status', 'delivered')
                ->whereMonth('delivered_at', $m)
                ->whereYear('delivered_at', $now->year)
                ->sum('total_amount');
        }

        // Đơn mới nhất
        $latestOrder = Order::orderByDesc('created_at')
            ->first(['order_code', 'customer_name', 'total_amount', 'created_at']);

        return view('admin.orders.stats', compact(
            'totalOrders',
            'deliveredOrders',
            'cancelledOrders',
            'processingOrders',
            'pendingOrders',
            'returnedOrders',
            'totalRevenueThisMonth',
            'averageOrderValue',
            'successRate',
            'cancellationRate',
            'momRevenueGrowth',
            'yoyRevenueGrowth',
            'sparklineLabels',
            'sparklineData',
            'chartLabels',
            'chartCounts',
            'chartAmounts',
            'latestOrder'
        ));
    }

    /**
     * Gán shipper cho đơn hàng
     */
    public function assignShipper(Request $request, Order $order)
    {
        $request->validate([
            'shipper_id' => 'required|exists:shippers,id'
        ]);

        try {
            $shipper = \App\Models\Shipper::findOrFail($request->shipper_id);
            
            // Kiểm tra shipper có đang hoạt động không
            if ($shipper->status !== 'active') {
                return redirect()->back()->with('error', 'Shipper này hiện đang tạm ngưng hoạt động!');
            }

            // Gán shipper cho đơn hàng
            $order->update([
                'shipper_id' => $shipper->id,
                'order_status' => 'processing' // Chuyển sang đang xử lý
            ]);

            return redirect()->back()->with('success', "Đã phân chia đơn hàng #{$order->order_code} cho shipper {$shipper->name}!");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi phân chia shipper: ' . $e->getMessage());
        }
    }

    /**
     * Đổi shipper cho đơn hàng
     */
    public function changeShipper(Request $request, Order $order)
    {
        $request->validate([
            'shipper_id' => 'required|exists:shippers,id',
            'change_reason' => 'nullable|string|max:500'
        ]);

        try {
            $oldShipper = $order->shipper;
            $newShipper = \App\Models\Shipper::findOrFail($request->shipper_id);
            
            // Kiểm tra shipper mới có đang hoạt động không
            if ($newShipper->status !== 'active') {
                return redirect()->back()->with('error', 'Shipper mới này hiện đang tạm ngưng hoạt động!');
            }

            // Kiểm tra không đổi sang chính shipper hiện tại
            if ($order->shipper_id == $request->shipper_id) {
                return redirect()->back()->with('error', 'Shipper mới không thể trùng với shipper hiện tại!');
            }

            // Cập nhật shipper
            $order->update([
                'shipper_id' => $newShipper->id
            ]);

            // Log lý do đổi shipper (có thể lưu vào bảng order_logs sau này)
            if ($request->change_reason) {
                // TODO: Lưu log đổi shipper
            }

            $message = "Đã đổi shipper cho đơn hàng #{$order->order_code}";
            if ($oldShipper) {
                $message .= " từ {$oldShipper->name} sang {$newShipper->name}";
            } else {
                $message .= " thành {$newShipper->name}";
            }

            return redirect()->back()->with('success', $message . '!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đổi shipper: ' . $e->getMessage());
        }
    }
}
