# Tính năng Kiểm tra Sản phẩm - Backend Only

## Tổng quan
Tính năng này sử dụng hoàn toàn backend để kiểm tra sản phẩm hết hàng và ngừng kinh doanh khi đặt hàng. Không sử dụng JavaScript validation và không dùng service riêng.

## Cách hoạt động

### 1. Form HTML thuần
- Form POST trực tiếp đến `client.checkout.prepare`
- Hidden inputs cho tất cả sản phẩm trong giỏ hàng
- Không cần JavaScript validation

### 2. Backend Validation
- `CheckoutController::prepareCheckout()` kiểm tra sản phẩm
- Logic validation trực tiếp trong controller
- Tự động xóa sản phẩm không hợp lệ khỏi giỏ hàng

### 3. Thông báo Laravel
- Sử dụng `session()->flash()` để hiển thị thông báo
- Redirect về trang cart với thông báo lỗi/cảnh báo

## Các trường hợp kiểm tra

1. **Giỏ hàng trống**
2. **Sản phẩm không tồn tại**
3. **Sản phẩm ngừng kinh doanh** (status: draft, archived, out_of_stock)
4. **Sản phẩm hết hàng** (stock_quantity < quantity)
5. **Biến thể không tồn tại**

## Files đã cập nhật

- `resources/views/client/cart/cart.blade.php` - Form HTML thuần và thông báo
- `app/Http/Controllers/client/CheckoutController.php` - Logic validation trực tiếp

## Ưu điểm

- ✅ Hoàn toàn không dùng JavaScript validation
- ✅ Form HTML thuần, đơn giản
- ✅ Logic validation đơn giản trong controller
- ✅ Validation chính xác từ database
- ✅ Thông báo rõ ràng bằng Laravel session
- ✅ Tự động dọn dẹp giỏ hàng
- ✅ UX tốt với thông báo
