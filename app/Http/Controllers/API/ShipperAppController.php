<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipper;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ShipperAppController extends Controller
{
    /**
     * Đăng nhập shipper
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $shipper = Shipper::where('email', $request->email)->first();

            if (!$shipper || !Hash::check($request->password, $shipper->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email hoặc mật khẩu không đúng'
                ], 401);
            }

            // Kiểm tra trạng thái shipper
            if ($shipper->status !== 'active') {
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản của bạn đã bị tạm ngưng hoạt động'
                ], 403);
            }

            // Xóa token cũ
            $shipper->tokens()->delete();

            // Tạo token mới
            $token = $shipper->createToken('shipper-app-token')->plainTextToken;

            // Cập nhật thời gian đăng nhập cuối
            $shipper->update(['last_login_at' => now()]);

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'data' => [
                    'token' => $token,
                    'shipper' => [
                        'id' => $shipper->id,
                        'name' => $shipper->name,
                        'email' => $shipper->email,
                        'phone' => $shipper->phone,
                        'address' => $shipper->address,
                        'status' => $shipper->status,
                        'last_login_at' => $shipper->last_login_at
                    ]
                ]
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Shipper login error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lấy thông tin profile shipper
     */
    public function getProfile()
    {
        try {
            $shipper = Auth::user();
            
            if (!$shipper) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không có quyền truy cập'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $shipper->id,
                    'name' => $shipper->name,
                    'email' => $shipper->email,
                    'phone' => $shipper->phone,
                    'address' => $shipper->address,
                    'status' => $shipper->status,
                    'last_login_at' => $shipper->last_login_at,
                    'created_at' => $shipper->created_at
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Get shipper profile error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy thông tin profile'
            ], 500);
        }
    }

    /**
     * Cập nhật profile shipper
     */
    public function updateProfile(Request $request)
    {
        try {
            $shipper = Auth::user();
            
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
            ]);

            $shipper->update($request->only(['name', 'phone', 'address']));

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thông tin thành công',
                'data' => [
                    'id' => $shipper->id,
                    'name' => $shipper->name,
                    'email' => $shipper->email,
                    'phone' => $shipper->phone,
                    'address' => $shipper->address,
                    'status' => $shipper->status
                ]
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update shipper profile error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi cập nhật thông tin'
            ], 500);
        }
    }

    /**
     * Đổi mật khẩu
     */
    public function changePassword(Request $request)
    {
        try {
            $shipper = Auth::user();
            
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'required|same:new_password',
            ]);

            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->current_password, $shipper->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mật khẩu hiện tại không đúng'
                ], 400);
            }

            // Cập nhật mật khẩu mới
            $shipper->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Đổi mật khẩu thành công'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Change password error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi đổi mật khẩu'
            ], 500);
        }
    }

    /**
     * Lấy danh sách đơn hàng của shipper
     */
    public function getOrders(Request $request)
    {
        try {
            $shipper = Auth::user();

            if (!$shipper) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không có quyền truy cập'
                ], 401);
            }

            // Lấy tất cả đơn hàng của shipper
            $orders = Order::where('shipper_id', $shipper->id)
                ->with(['user', 'orderItems.product'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Tính toán thống kê
            $stats = [
                'total_orders' => $orders->count(),
                'processing_orders' => $orders->whereIn('order_status', ['processing', 'shipped'])->count(),
                'delivered_orders' => $orders->where('order_status', 'delivered')->count(),
                'today_orders' => $orders->where('created_at', '>=', Carbon::today())->count(),
                'total_earnings' => $orders->where('order_status', 'delivered')->sum('total_amount')
            ];

            return response()->json([
                'success' => true,
                'data' => [
                    'orders' => $orders,
                    'stats' => $stats
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Get shipper orders error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy danh sách đơn hàng'
            ], 500);
        }
    }

    /**
     * Lấy chi tiết đơn hàng
     */
    public function getOrder($id)
    {
        try {
            $shipper = Auth::user();
            
            $order = Order::where('id', $id)
                ->where('shipper_id', $shipper->id)
                ->with(['user', 'items.product.images', 'items.productVariant', 'status_histories', 'paymentMethod', 'shippingMethod'])
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
            }

            // Debug log để xem dữ liệu paymentMethod
            \Log::info('Order payment method:', [
                'payment_method_id' => $order->payment_method_id,
                'paymentMethod' => $order->paymentMethod,
                'payment_method' => $order->payment_method
            ]);

            return response()->json([
                'success' => true,
                'data' => $order
            ]);

        } catch (\Exception $e) {
            Log::error('Get order detail error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy chi tiết đơn hàng'
            ], 500);
        }
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function updateOrderStatus(Request $request, $id)
    {
        try {
            $shipper = Auth::user();
            
            $request->validate([
                'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled,returned',
                'notes' => 'nullable|string|max:500',
                'location' => 'nullable|array',
                'location.lat' => 'nullable|numeric',
                'location.lng' => 'nullable|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $order = Order::where('id', $id)
                ->where('shipper_id', $shipper->id)
                ->with(['orderItems.product', 'orderItems.productVariant'])
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
            }

            \Log::info("Order loaded for status update", [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'order_items_count' => $order->orderItems->count(),
                'status' => $request->status
            ]);

            // Cập nhật trạng thái
            $order->update([
                'order_status' => $request->status,
                'delivery_notes' => $request->notes,
                'delivered_at' => $request->status === 'delivered' ? now() : null
            ]);

            // Xử lý hoàn trả về kho
            if ($request->status === 'returned') {
                \Log::info("Processing return to warehouse for order #{$order->order_code}");
                $this->returnItemsToWarehouse($order);
            }

            // Lưu vị trí nếu có
            if ($request->location) {
                $order->update([
                    'delivery_lat' => $request->location['lat'],
                    'delivery_lng' => $request->location['lng']
                ]);
            }

            // Xử lý upload ảnh
            $imagePath = null;
            \Log::info('Debug upload image:', [
                'hasFile' => $request->hasFile('image'),
                'allFiles' => $request->allFiles(),
                'allData' => $request->all(),
                'contentType' => $request->header('Content-Type'),
                'contentLength' => $request->header('Content-Length')
            ]);
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                \Log::info('Image file details:', [
                    'originalName' => $image->getClientOriginalName(),
                    'mimeType' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'error' => $image->getError()
                ]);
                
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('order_images', $imageName, 'public');
                \Log::info('Image uploaded:', ['path' => $imagePath]);
            } else {
                \Log::info('No image file found');
                \Log::info('Request files:', $request->allFiles());
                \Log::info('Request input:', $request->all());
            }

            // Tạo lịch sử status
            $order->status_histories()->create([
                'status' => $request->status,
                'admin_note' => $request->notes,
                'image_path' => $imagePath,
                'created_at' => now(),
            ]);

            // Tạo thông báo cho khách hàng
            $this->createOrderNotification($order, $request->status, $request->notes);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công',
                'data' => $order->fresh(['user', 'orderItems.product', 'status_histories'])
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update order status error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi cập nhật trạng thái đơn hàng'
            ], 500);
        }
    }

    /**
     * Hoàn trả sản phẩm về kho
     */
    private function returnItemsToWarehouse($order)
    {
        try {
            \Log::info("Starting return to warehouse process for order #{$order->order_code}", [
                'order_id' => $order->id,
                'total_items' => $order->orderItems->count()
            ]);

            foreach ($order->orderItems as $item) {
                \Log::info("Processing order item", [
                    'item_id' => $item->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'has_product' => $item->product ? 'yes' : 'no',
                    'has_variant' => $item->productVariant ? 'yes' : 'no'
                ]);

                // Nếu có product variant, cập nhật stock của variant
                if ($item->productVariant) {
                    $oldStock = $item->productVariant->stock_quantity;
                    $item->productVariant->stock_quantity += $item->quantity;
                    $result = $item->productVariant->save();

                    \Log::info("Variant stock update result", [
                        'variant_id' => $item->productVariant->id,
                        'product_id' => $item->productVariant->product_id,
                        'old_stock' => $oldStock,
                        'quantity_returned' => $item->quantity,
                        'new_stock' => $item->productVariant->stock_quantity,
                        'save_result' => $result
                    ]);

                    \Log::info("Successfully returned {$item->quantity} units of variant to warehouse", [
                        'order_id' => $order->id,
                        'variant_id' => $item->productVariant->id,
                        'product_id' => $item->productVariant->product_id,
                        'quantity_returned' => $item->quantity,
                        'new_stock' => $item->productVariant->stock_quantity
                    ]);
                }
                // Nếu không có variant nhưng có product, cập nhật stock của product
                elseif ($item->product) {
                    $oldStock = $item->product->stock_quantity;
                    $item->product->stock_quantity += $item->quantity;
                    $result = $item->product->save();

                    \Log::info("Product stock update result", [
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->name,
                        'old_stock' => $oldStock,
                        'quantity_returned' => $item->quantity,
                        'new_stock' => $item->product->stock_quantity,
                        'save_result' => $result
                    ]);

                    \Log::info("Successfully returned {$item->quantity} units of product {$item->product->name} to warehouse", [
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'quantity_returned' => $item->quantity,
                        'new_stock' => $item->product->stock_quantity
                    ]);
                } else {
                    \Log::warning("Neither product nor variant found for order item", [
                        'item_id' => $item->id,
                        'product_id' => $item->product_id,
                        'product_variant_id' => $item->product_variant_id
                    ]);
                }
            }

            \Log::info("Completed return to warehouse process for order #{$order->order_code}");
        } catch (\Exception $e) {
            \Log::error('Error returning items to warehouse: ' . $e->getMessage(), [
                'order_id' => $order->id,
                'exception' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Lấy thông báo
     */
    public function getNotifications()
    {
        try {
            $shipper = Auth::user();
            
            $notifications = Notification::where('shipper_id', $shipper->id)
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();

            $unreadCount = $notifications->where('read_at', null)->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'notifications' => $notifications,
                    'unread_count' => $unreadCount
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Get notifications error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy thông báo'
            ], 500);
        }
    }

    /**
     * Đánh dấu thông báo đã đọc
     */
    public function markNotificationAsRead($id)
    {
        try {
            $shipper = Auth::user();
            
            $notification = Notification::where('id', $id)
                ->where('shipper_id', $shipper->id)
                ->first();

            if (!$notification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy thông báo'
                ], 404);
            }

            $notification->update(['read_at' => now()]);

            return response()->json([
                'success' => true,
                'message' => 'Đã đánh dấu đã đọc'
            ]);

        } catch (\Exception $e) {
            Log::error('Mark notification as read error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi đánh dấu thông báo'
            ], 500);
        }
    }

    /**
     * Đánh dấu tất cả thông báo đã đọc
     */
    public function markAllNotificationsAsRead()
    {
        try {
            $shipper = Auth::user();
            
            Notification::where('shipper_id', $shipper->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            return response()->json([
                'success' => true,
                'message' => 'Đã đánh dấu tất cả thông báo đã đọc'
            ]);

        } catch (\Exception $e) {
            Log::error('Mark all notifications as read error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi đánh dấu thông báo'
            ], 500);
        }
    }

    /**
     * Cập nhật vị trí shipper
     */
    public function updateLocation(Request $request)
    {
        try {
            $shipper = Auth::user();
            
            $request->validate([
                'lat' => 'required|numeric',
                'lng' => 'required|numeric',
                'accuracy' => 'nullable|numeric',
                'speed' => 'nullable|numeric',
                'heading' => 'nullable|numeric',
            ]);

            $shipper->update([
                'current_lat' => $request->lat,
                'current_lng' => $request->lng,
                'location_updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật vị trí thành công'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update location error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi cập nhật vị trí'
            ], 500);
        }
    }

    /**
     * Đăng xuất
     */
    public function logout()
    {
        try {
            $shipper = Auth::user();
            
            // Xóa tất cả token
            $shipper->tokens()->delete();
            
            // Cập nhật trạng thái offline
            $shipper->update([
                'is_online' => false,
                'last_online_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Đăng xuất thành công'
            ]);

        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi đăng xuất'
            ], 500);
        }
    }

    /**
     * Tạo thông báo cho đơn hàng
     */
    private function createOrderNotification($order, $status, $notes = '')
    {
        try {
            $statusMessages = [
                'processing' => 'Shipper đã nhận đơn hàng và đang chuẩn bị giao',
                'shipped' => 'Đơn hàng đang được giao',
                'delivered' => 'Đơn hàng đã được giao thành công',
                'cancelled' => 'Đơn hàng đã bị hủy'
            ];

            $message = $statusMessages[$status] ?? 'Trạng thái đơn hàng đã được cập nhật';
            
            if ($notes) {
                $message .= ' - ' . $notes;
            }

            // Tạo thông báo cho khách hàng
            if ($order->user) {
                // Có thể gửi push notification hoặc email ở đây
                Log::info("Order notification for user {$order->user->id}: {$message}");
            }

        } catch (\Exception $e) {
            Log::error('Create order notification error: ' . $e->getMessage());
        }
    }
}