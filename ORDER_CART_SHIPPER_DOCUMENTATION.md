[//]: # (Tài liệu nâng cao: Luồng dữ liệu, demo API và hướng dẫn thuyết trình)

# Tài liệu Hệ thống Đơn hàng — Giỏ hàng — Shipper (Chi tiết + Demo)

Mục tiêu: giúp bạn thuyết trình và demo tuần tự từ hành động người dùng (client) -> tạo đơn hàng -> xử lý admin -> phân công shipper -> giao hàng, kèm ví dụ API, payload, và kịch bản UI minh họa.

## Checklist yêu cầu
- Thêm liên kết rõ ràng giữa Cart, Order và Shipper — Done
- Cung cấp luồng dữ liệu (sequence) giữa các phần — Done
- Demo đầy đủ tính năng (API + UI steps + expected state) — Done
- Ví dụ payload và các endpoint để test nhanh — Done

---

## 1. Hợp đồng (contract) ngắn gọn

- Inputs: hành động client (add-to-cart, update-qty, checkout), action admin (confirm, assign), action shipper (accept, pickup, delivered).
- Outputs: cart state, order record (with status, totals, items, shipper_id), shipper assignment and delivery status.
- Data shapes (tối giản):
	- Cart item: { product_id, name, price, qty }
	- Order: { id, user_id, items:[Cart item], total_amount, status, payment_status, shipper_id, address }
	- Shipper update: { order_id, status, lat?, lng?, note? }

Edge cases chính: giỏ rỗng khi checkout, lượng tồn kho không đủ, thanh toán thất bại, shipper không nhận, cập nhật trạng thái không hợp lệ.

---

## 2. Luồng dữ liệu (Cart -> Order -> Shipper)

1) Người dùng thêm sản phẩm vào giỏ (session hoặc DB). CartController ghi cart vào session hoặc cart table.
2) Người dùng checkout: frontend gửi POST `/api/orders` với cart và địa chỉ.
	 - Backend kiểm tra inventory, tính toán phí ship, khởi tạo order với status = "pending" và payment_status = "unpaid".
3) Sau khi thanh toán thành công (webhook / callback), order.payment_status = "paid"; hệ thống gửi notification cho admin.
4) Admin xác nhận order (status -> "confirmed") và phân công shipper (shipper_id được gán).
5) Shipper nhận thông báo, chấp nhận đơn (status -> "accepted"), lấy hàng (status -> "picking"), đang giao ("on_delivery"), hoàn tất ("delivered").
6) Sau delivered, customer xác nhận và order status -> "completed".

Sequence ngắn (text):
Client -> CartController (add) -> Session
Client -> OrderController (checkout) -> Order (pending)
Payment gateway -> OrderController (callback) -> Order (paid)
Admin -> OrderController (confirm + assign) -> Order (confirmed, shipper_id)
Shipper -> ShipperController (status updates) -> Order (on_delivery/delivered)

---

## 3. File/Module mapping (chi tiết hơn để bạn trình bày)

- Cart
	- `app/Http/Controllers/CartController.php`: add/update/remove API + session handling
	- `resources/views/client/cart/*`: UI
	- `app/Services/CartService.php` (nếu tồn tại): business logic

- Order
	- `app/Http/Controllers/OrderController.php`: checkout, webhook, status update
	- `app/Models/Order.php`, `app/Models/OrderItem.php`
	- `app/Helpers/OrderHelper.php`: fee calculation, invoice data
	- `resources/views/admin/orders/*` và `resources/views/client/order/*`

- Shipper
	- `app/Http/Controllers/ShipperController.php`: endpoints shipper
	- `app/Models/Shipper.php`
	- `resources/views/admin/orders/tracking.blade.php`: tracking UI
	- WebSocket: `app/WebSocket/*` hoặc service push notifications

---

## 4. Demo API — kịch bản end-to-end (bạn có thể chạy cho buổi thuyết trình)

Giả sử server chạy ở http://localhost:8000 và bạn đã login/đăng nhập (hoặc dùng token).

1) Thêm sản phẩm vào cart

Powershell (curl):

```powershell
curl -X POST "http://localhost:8000/api/cart/add" -H "Content-Type: application/json" -d '{"product_id": 12, "qty": 2}'
```

Expected response: cart object with items và totals.

2) Xem cart

```powershell
curl "http://localhost:8000/api/cart"
```

3) Checkout — tạo order (sample payload)

```powershell
curl -X POST "http://localhost:8000/api/orders" -H "Content-Type: application/json" -d '{
	"user_id": 5,
	"address": "123 Đường A, Quận B",
	"payment_method": "paypal",
	"items": [{"product_id":12,"qty":2}],
	"shipping_fee": 30000
}'
```

Expected: HTTP 201 với object order: { id, status: "pending", payment_status: "unpaid", total_amount }

4) Thanh toán (mô phỏng): gọi webhook hoặc endpoint callback

```powershell
curl -X POST "http://localhost:8000/api/orders/123/payment-callback" -H "Content-Type: application/json" -d '{"status":"success","transaction_id":"tx_abc"}'
```

Order được cập nhật: payment_status = "paid", status = "confirmed" (hoặc chờ admin tùy config).

5) Admin phân công shipper (manual via admin UI hoặc API)

```powershell
curl -X PUT "http://localhost:8000/api/orders/123/assign" -H "Content-Type: application/json" -d '{"shipper_id":7}'
```

Expected: order.shipper_id = 7, status = "assigned" (notify shipper)

6) Shipper cập nhật trạng thái

```powershell
curl -X PUT "http://localhost:8000/api/shipper/orders/123/status" -H "Content-Type: application/json" -d '{"status":"on_delivery"}'
```

Sau khi delivered:

```powershell
curl -X PUT "http://localhost:8000/api/shipper/orders/123/status" -H "Content-Type: application/json" -d '{"status":"delivered"}'
```

Expected final: order.status = "delivered" -> customer xác nhận -> order.status = "completed".

---

## 5. UI Demo (bước thuyết trình trên giao diện)

Chuỗi bước bạn chạy trên UI:

1. Mở trang sản phẩm, nhấn "Thêm vào giỏ" (kiểm tra số lượng hiển thị trong `resources/views/client/cart/*`).
2. Vào trang giỏ hàng, thay đổi qty, click cập nhật — kiểm tra session hoặc DB `cart`/`cart_items`.
3. Nhấn "Thanh toán" — điền địa chỉ và phương thức thanh toán — gửi đơn.
4. Mở trang admin `resources/views/admin/orders/index.blade.php`, tìm order mới: confirm -> assign shipper.
5. Mở `resources/views/admin/orders/tracking.blade.php` để theo dõi hoặc mở giao diện shipper để cập nhật trạng thái.

Trong buổi demo, thao tác từng bước và show console logs / Network tab để minh họa payload.

---

## 6. Kiểm thử nhanh (smoke tests) — ý tưởng để bạn demo chứng minh tính hoạt động

- Test A (Cart -> Order): run API sequence add -> view -> checkout -> assert order created.
- Test B (Payment callback): gửi payload giả, assert payment_status=paid.
- Test C (Assign shipper + status updates): assign shipper -> update status sequence -> assert final status.

Bạn có thể tự tạo 3 script nhỏ (powershell) để gọi các endpoint ở phần 4, và show responses trên màn hình.

---

## 7. Các lưu ý khi demo

- Môi trường local: chạy `php artisan serve` hoặc docker-compose lên DB.
- Nếu dùng session-based cart, demo cần cùng browser context; nếu token-based, truyền token.
- Chuẩn bị 1 product có stock > 10 để không gặp lỗi inventory.

---

## 8. Gợi ý slide trình bày

1. Mục tiêu và tóm tắt flow (1 slide)
2. Data model (order, cart, shipper) (1 slide)
3. Sequence flow (client -> order -> admin -> shipper) (1 slide)
4. Live demo: API calls (thực hiện theo script) + UI (2-3 phút)
5. Edge cases & cách xử lý (1 slide)

---

Nếu bạn muốn, tôi có thể:
- Tạo sẵn 3 script PowerShell cho demo (add-to-cart, checkout, shipper flow).
- Viết unit/integration tests nhỏ (PHPUnit) để tự động hoá smoke tests.

Chọn 1 trong 2 để tôi tiếp tục thực hiện.
