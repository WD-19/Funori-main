<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipper;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ShipperController extends Controller
{
    /**
     * Hiển thị danh sách shipper
     */
    public function index(Request $request)
    {
        $query = Shipper::withCount(['orders']);

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $shippers = $query->orderBy('created_at', 'desc')->get();

        return view('admin.shippers.index', compact('shippers'));
    }

    /**
     * Hiển thị form tạo shipper mới
     */
    public function create()
    {
        return view('admin.shippers.create');
    }

    /**
     * Lưu shipper mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:shippers',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Shipper::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.shippers.index')
            ->with('success', 'Đã tạo shipper mới thành công!');
    }

    /**
     * Hiển thị chi tiết shipper
     */
    public function show(Shipper $shipper)
    {
        $orders = $shipper->orders()
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'total_orders' => $shipper->orders()->count(),
            // Đồng bộ hoá luồng trạng thái: coi "processing" là đã được phân cho shipper và đang xử lý
            'assigned_orders' => $shipper->orders()->where('order_status', 'processing')->count(),
            'received_orders' => $shipper->orders()->where('order_status', 'processing')->count(),
            'in_delivery_orders' => $shipper->orders()->where('order_status', 'shipped')->count(),
            'delivered_orders' => $shipper->orders()->where('order_status', 'delivered')->count(),
            'failed_orders' => $shipper->orders()->where('order_status', 'failed')->count(),
        ];

        return view('admin.shippers.show', compact('shipper', 'orders', 'stats'));
    }

    /**
     * Hiển thị chi tiết shipper (alias cho show)
     */
    public function showDetails(Shipper $shipper)
    {
        return $this->show($shipper);
    }

    /**
     * Hiển thị form chỉnh sửa shipper
     */
    public function edit(Shipper $shipper)
    {
        return view('admin.shippers.edit', compact('shipper'));
    }

    /**
     * Cập nhật thông tin shipper
     */
    public function update(Request $request, Shipper $shipper)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:shippers,email,' . $shipper->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address', 'status']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $shipper->update($data);

        return redirect()->route('admin.shippers.index')
            ->with('success', 'Đã cập nhật thông tin shipper thành công!');
    }

    /**
     * Xóa shipper
     */
    public function destroy(Shipper $shipper)
    {
        // Kiểm tra nếu shipper có đơn hàng đang xử lý
        $activeOrders = $shipper->orders()
            ->whereIn('order_status', ['processing', 'shipped'])
            ->count();

        if ($activeOrders > 0) {
            return redirect()->route('admin.shippers.index')
                ->with('error', "Không thể xóa shipper này vì đang có {$activeOrders} đơn hàng đang xử lý!");
        }

        $shipper->delete();

        return redirect()->route('admin.shippers.index')
            ->with('success', 'Đã xóa shipper thành công!');
    }

    /**
     * Phân chia đơn hàng cho shipper
     */
    public function assignOrders()
    {
        // Chỉ cho phép phân shipper khi đơn đang ở trạng thái processing (đã xử lý) và chưa có shipper
        $unassignedOrders = Order::where('order_status', 'processing')
            ->whereNull('shipper_id')
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Lấy danh sách shipper đang hoạt động
        $activeShippers = Shipper::where('status', 'active')
            ->withCount(['orders' => function($query) {
                // Tính workload theo các trạng thái thực tế đang dùng cho shipper
                $query->whereIn('order_status', ['processing', 'shipped']);
            }])
            ->get();

        return view('admin.shippers.assign-orders', compact('unassignedOrders', 'activeShippers'));
    }

    /**
     * Thực hiện phân chia đơn hàng
     */
    public function processAssignOrders(Request $request)
    {
        // Debug: Log incoming request
        \Log::info('🚀 processAssignOrders called', [
            'method' => $request->method(),
            'url' => $request->url(),
            'all_data' => $request->all(),
            'headers' => $request->headers->all()
        ]);
        
        // Debug: Log incoming request
        \Log::info('🚀 processAssignOrders called', [
            'method' => $request->method(),
            'url' => $request->url(),
            'all_data' => $request->all(),
            'headers' => $request->headers->all()
        ]);
        
        // Validate request - chỉ cần có assignments array
        $request->validate([
            'assignments' => 'required|array',
        ]);

        $assignedCount = 0;
        $skippedCount = 0;
        $errors = [];

        foreach ($request->assignments as $assignment) {
            // Kiểm tra xem có order_id và shipper_id không
            if (!isset($assignment['order_id']) || !isset($assignment['shipper_id'])) {
                continue; // Bỏ qua nếu thiếu dữ liệu
            }

            $order = Order::find($assignment['order_id']);
            $shipper = Shipper::find($assignment['shipper_id']);

            // Validate order và shipper
            if (!$order) {
                \Log::warning("Order not found", ['order_id' => $assignment['order_id']]);
                continue;
            }

            if (!$shipper) {
                \Log::warning("Shipper not found", ['shipper_id' => $assignment['shipper_id']]);
                continue;
            }

            // Kiểm tra xem đơn hàng đã có shipper chưa
            if ($order->shipper_id) {
                \Log::info("Order already has shipper", [
                    'order_id' => $order->id,
                    'order_code' => $order->order_code,
                    'current_shipper_id' => $order->shipper_id
                ]);
                continue;
            }

            try {
                // Update order với shipper - đơn giản
                $order->shipper_id = $shipper->id;
                $order->save();

                $assignedCount++;
                
                // Log thành công
                \Log::info("✅ Order assigned successfully", [
                    'order_id' => $order->id,
                    'order_code' => $order->order_code,
                    'shipper_id' => $shipper->id,
                    'shipper_name' => $shipper->name
                ]);

            } catch (\Exception $e) {
                \Log::error("❌ Error assigning order", [
                    'order_id' => $order->id,
                    'shipper_id' => $shipper->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        // Response message đơn giản
        if ($assignedCount > 0) {
            $message = "✅ Đã phân chia {$assignedCount} đơn hàng thành công!";
            
            \Log::info("🎯 Assignment completed successfully", [
                'assigned_count' => $assignedCount,
                'request_data' => $request->all()
            ]);
            
            return redirect()->route('admin.shippers.assign-orders')
                ->with('success', $message);
        } else {
            $message = "❌ Không có đơn hàng nào được phân chia thành công!";
            
            \Log::warning("⚠️ No orders assigned", [
                'request_data' => $request->all()
            ]);
            
            return redirect()->route('admin.shippers.assign-orders')
                ->with('error', $message);
        }
    }

    /**
     * Phân chia tự động đơn hàng
     */
    public function autoAssignOrders()
    {
        // Lấy các đơn hàng chưa có shipper
        $unassignedOrders = Order::whereNull('shipper_id')
            ->orderBy('created_at', 'asc')
            ->get();

        if ($unassignedOrders->isEmpty()) {
            return redirect()->route('admin.shippers.assign-orders')
                ->with('info', 'Không có đơn hàng nào cần phân chia!');
        }

        // Lấy shipper có ít đơn hàng nhất
        $availableShippers = Shipper::where('status', 'active')
            ->withCount(['orders' => function($query) {
                $query->whereIn('order_status', ['processing', 'shipped']);
            }])
            ->orderBy('orders_count', 'asc')
            ->get();

        if ($availableShippers->isEmpty()) {
            return redirect()->route('admin.shippers.assign-orders')
                ->with('error', 'Không có shipper nào đang hoạt động!');
        }

        $assignedCount = 0;
        $shipperIndex = 0;

        foreach ($unassignedOrders as $order) {
            $shipper = $availableShippers[$shipperIndex % $availableShippers->count()];
            
            $order->update([
                'shipper_id' => $shipper->id,
                // Đồng bộ: chuyển thẳng sang processing khi đã phân cho shipper
                'order_status' => 'processing'
            ]);

            $assignedCount++;
            $shipperIndex++;
        }

        return redirect()->route('admin.shippers.assign-orders')
            ->with('success', "Đã tự động phân chia {$assignedCount} đơn hàng cho {$availableShippers->count()} shipper!");
    }
}