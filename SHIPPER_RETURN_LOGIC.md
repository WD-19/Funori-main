# Logic Hoàn Hàng Về Kho - Shipper App

## Vấn đề trước đây
Trước đây, nút "Xác nhận đã hoàn về kho" hiển thị cho tất cả đơn hàng có trạng thái `cancelled` (đã hủy) và `failed` (thất bại). Điều này gây ra vấn đề logic:

- **Đơn hàng đang xử lý (`processing`)** → Admin hủy → Chuyển thành `cancelled`
- Shipper chưa bấm "nhận hàng" → Không có quyền "hoàn về kho"
- Hàng vẫn ở kho, không cần "hoàn về kho"

## Logic mới (Đã sửa)
Nút "Xác nhận đã hoàn về kho" **CHỈ** hiển thị khi:

### ✅ Hiển thị nút:
- **Trạng thái `failed`**: Đơn hàng đã được shipper nhận và giao thất bại
- Shipper đã bấm "nhận hàng" → Có quyền "hoàn về kho"
- Hàng đã được lấy ra khỏi kho → Cần "hoàn về kho"

### ❌ KHÔNG hiển thị nút:
- **Trạng thái `cancelled`**: Đơn hàng bị admin hủy trước khi shipper nhận
- Shipper chưa bấm "nhận hàng" → Không có quyền "hoàn về kho"
- Hàng vẫn ở kho → Không cần "hoàn về kho"

## Luồng xử lý đơn hàng

### 1. Đơn hàng bị admin hủy (trạng thái `cancelled`)
```
Đơn hàng: pending → confirmed → processing → cancelled
Shipper: Chưa nhận hàng
Hàng: Vẫn ở kho
Action: KHÔNG hiển thị nút "hoàn về kho"
```

### 2. Đơn hàng giao thất bại (trạng thái `failed`)
```
Đơn hàng: pending → confirmed → processing → shipped → failed
Shipper: Đã nhận hàng và giao thất bại
Hàng: Đã lấy ra khỏi kho
Action: HIỂN THỊ nút "hoàn về kho"
```

## Các thay đổi đã thực hiện

### 1. OrderDetail.vue
- **Điều kiện hiển thị nút**: `v-if="order.order_status === 'failed"`
- **Tiêu đề modal**: "Xác nhận hoàn hàng về kho (Giao thất bại)"
- **Thông báo**: Chỉ rõ đây là đơn hàng giao thất bại

### 2. Dashboard.vue
- **Label trạng thái**: `'failed': 'Giao thất bại'`
- **Filter option**: "Giao thất bại" thay vì "Thất bại"

### 3. Logic xử lý
- **Function `returnToWarehouse`**: Chỉ xử lý đơn hàng `failed`
- **Ghi chú**: "Đã hoàn trả hàng về kho do giao thất bại"

## Lợi ích của logic mới

1. **Logic chính xác**: Chỉ shipper đã nhận hàng mới có quyền hoàn về kho
2. **Tránh nhầm lẫn**: Không hiển thị nút không cần thiết cho đơn hàng bị hủy
3. **Quyền rõ ràng**: Shipper chỉ xử lý hàng họ đã nhận
4. **Quản lý kho tốt hơn**: Tránh việc "hoàn về kho" không cần thiết

## Kiểm tra và test

### Test case 1: Đơn hàng bị admin hủy
- Tạo đơn hàng → Chuyển sang `processing`
- Admin hủy đơn hàng → Chuyển sang `cancelled`
- **Kết quả**: Không hiển thị nút "hoàn về kho" ✅

### Test case 2: Đơn hàng giao thất bại
- Tạo đơn hàng → Shipper nhận → Chuyển sang `shipped`
- Shipper báo giao thất bại → Chuyển sang `failed`
- **Kết quả**: Hiển thị nút "hoàn về kho" ✅

### Test case 3: Đơn hàng thành công
- Tạo đơn hàng → Shipper giao thành công → Chuyển sang `delivered`
- **Kết quả**: Không hiển thị nút "hoàn về kho" ✅
