# Chuyển đổi Giỏ hàng từ Session sang Database

## Tổng quan
Đã thực hiện chuyển đổi hệ thống giỏ hàng từ lưu trữ trong session sang lưu trữ trong database cho các user đã đăng nhập, trong khi vẫn giữ session cho guest users.

## Những thay đổi chính

### 1. Cập nhật CheckoutController
- **File**: `app/Http/Controllers/client/CheckoutController.php`
- **Thay đổi**:
  - Method `prepareCheckout()`: Lấy dữ liệu giỏ hàng từ database thay vì session cho user đã đăng nhập
  - Method `index()`: Sử dụng session `checkout` thay vì `cart` để lưu trữ dữ liệu checkout
  - Method `processCheckout()`: Xử lý dữ liệu từ session `checkout`
  - Thêm method `updateDiscount()`: Cập nhật discount trong checkout session
  - Tự động xóa sản phẩm đã checkout khỏi database cart

### 2. Cập nhật CartController
- **File**: `app/Http/Controllers/client/CartController.php`
- **Thay đổi**:
  - Method `cart()`: Lấy dữ liệu từ database cho user đã đăng nhập, session cho guest
  - Method `addToCart()`: Lưu vào database cho user đã đăng nhập, session cho guest
  - Method `updateCart()`: Cập nhật database cho user đã đăng nhập, session cho guest
  - Method `removeFromCart()`: Xóa từ database cho user đã đăng nhập, session cho guest
  - Method `clearCart()`: Xóa từ database cho user đã đăng nhập, session cho guest
  - Method `getCartCount()`: Đếm từ database cho user đã đăng nhập, session cho guest
  - Method `miniCart()`: Lấy từ database cho user đã đăng nhập, session cho guest

### 3. Tạo SyncCartMiddleware
- **File**: `app/Http/Middleware/SyncCartMiddleware.php`
- **Chức năng**: Tự động đồng bộ giỏ hàng từ session sang database khi user đăng nhập
- **Đăng ký**: Trong `bootstrap/app.php` với alias `sync.cart`

### 4. Cập nhật Routes
- **File**: `routes/web.php`
- **Thay đổi**:
  - Thêm route `checkout.update-discount` cho việc cập nhật discount
  - Áp dụng middleware `sync.cart` cho các route cart và checkout

### 5. Cập nhật View Checkout
- **File**: `resources/views/client/checkout/index.blade.php`
- **Thay đổi**:
  - Thêm section nhập mã giảm giá
  - Thêm JavaScript để xử lý áp dụng discount
  - Cập nhật logic tính toán tổng tiền với discount

## Cấu trúc Database
Sử dụng các bảng có sẵn:
- `carts`: Lưu thông tin giỏ hàng của user
- `cart_items`: Lưu các sản phẩm trong giỏ hàng

## Luồng hoạt động

### Cho User đã đăng nhập:
1. Thêm sản phẩm → Lưu vào database
2. Xem giỏ hàng → Lấy từ database
3. Checkout → Lấy từ database, lưu vào session `checkout`
4. Sau khi đặt hàng thành công → Xóa sản phẩm đã checkout khỏi database

### Cho Guest User:
1. Thêm sản phẩm → Lưu vào session
2. Xem giỏ hàng → Lấy từ session
3. Checkout → Lấy từ session, lưu vào session `checkout`
4. Sau khi đặt hàng thành công → Xóa session

### Đồng bộ khi đăng nhập:
1. User đăng nhập → Middleware `sync.cart` tự động chạy
2. Đồng bộ sản phẩm từ session sang database
3. Xóa session cart sau khi đồng bộ

## Lợi ích
1. **Bảo mật**: Dữ liệu giỏ hàng được lưu trữ an toàn trong database
2. **Đồng bộ**: Giỏ hàng được đồng bộ giữa các thiết bị
3. **Phân tích**: Có thể phân tích hành vi mua sắm của user
4. **Khôi phục**: Có thể khôi phục giỏ hàng khi user quay lại
5. **Tương thích**: Vẫn hỗ trợ guest users với session

## Lưu ý
- Guest users vẫn sử dụng session để đảm bảo trải nghiệm mượt mà
- Middleware tự động đồng bộ khi user đăng nhập
- Dữ liệu checkout được tách riêng khỏi giỏ hàng chính
- Hỗ trợ đầy đủ các tính năng: thêm, sửa, xóa, áp dụng discount 