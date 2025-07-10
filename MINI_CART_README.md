# Mini Cart Manager - Hướng dẫn sử dụng

## Tổng quan

Mini Cart Manager là một hệ thống quản lý giỏ hàng mini cho phép cập nhật nội dung giỏ hàng từ server một cách động mà không cần reload trang.

## Tính năng

- ✅ Cập nhật nội dung mini cart từ server
- ✅ Cập nhật badge số lượng giỏ hàng
- ✅ Thêm sản phẩm vào giỏ hàng và cập nhật mini cart
- ✅ Xóa sản phẩm khỏi giỏ hàng và cập nhật mini cart
- ✅ Cập nhật số lượng sản phẩm và cập nhật mini cart
- ✅ Hiển thị thông báo thành công/lỗi
- ✅ Hỗ trợ cả user đăng nhập và guest

## Cài đặt

### 1. Backend (Laravel)

#### Thêm route
```php
// routes/web.php
Route::get('/cart/mini', [CartController::class, 'getMiniCart'])->name('cart.mini');
```

#### Thêm method trong CartController
```php
// app/Http/Controllers/client/CartController.php
public function getMiniCart()
{
    // Xem code chi tiết trong file CartController.php
}
```

### 2. Frontend

#### Include JavaScript file
```html
<!-- Trong header hoặc layout -->
<script src="{{ asset('js/mini-cart.js') }}"></script>
```

## Cách sử dụng

### 1. Khởi tạo tự động

Mini Cart Manager sẽ tự động khởi tạo khi DOM đã sẵn sàng:

```javascript
// Tự động khởi tạo
window.miniCartManager = new MiniCartManager();
```

### 2. Cập nhật mini cart

```javascript
// Cập nhật toàn bộ mini cart từ server
window.miniCartManager.updateMiniCartContent();

// Hoặc sử dụng alias
window.miniCartManager.refresh();
```

### 3. Thêm sản phẩm vào giỏ hàng

```javascript
// Tạo FormData từ form
const form = document.getElementById('add-to-cart-form');
const formData = new FormData(form);

// Thêm vào giỏ hàng và cập nhật mini cart
window.miniCartManager.addToCartAndUpdate(formData);
```

### 4. Xóa sản phẩm khỏi giỏ hàng

```javascript
// Xóa sản phẩm và cập nhật mini cart
window.miniCartManager.removeFromCartAndUpdate(itemId);
```

### 5. Cập nhật số lượng sản phẩm

```javascript
// Cập nhật số lượng và cập nhật mini cart
window.miniCartManager.updateCartQuantityAndUpdate(itemId, quantity);
```

### 6. Cập nhật badge số lượng

```javascript
// Cập nhật badge số lượng giỏ hàng
window.miniCartManager.updateCartCountBadge(cartCount);
```

## API Response Format

### GET /cart/mini

```json
{
    "success": true,
    "cart_items": [
        {
            "id": "1",
            "product_id": 1,
            "product_variant_id": null,
            "quantity": 2,
            "price_at_addition": 150000,
            "image_url": "images/products/product1.jpg",
            "product": {
                "id": 1,
                "name": "Sản phẩm 1",
                "slug": "san-pham-1"
            },
            "variant": null
        }
    ],
    "cart_count": 3,
    "total": 450000,
    "has_more": true
}
```

## Tương thích ngược

Để đảm bảo tương thích với code cũ, các hàm sau vẫn hoạt động:

```javascript
// Các hàm tương thích ngược
updateCartCountBadge(newCount);
updateCartAfterAction();
addToCartAndUpdate(formData);
```

## Cấu trúc HTML cần thiết

### 1. Cart Count Badge
```html
<span class="cart-count-badge" id="cart-count-badge">
    0
</span>
```

### 2. Cart Popup Content
```html
<div id="cart-popup-content">
    <!-- Nội dung mini cart sẽ được cập nhật động -->
</div>
```

### 3. CSRF Token (cho Laravel)
```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

## Xử lý lỗi

Mini Cart Manager có xử lý lỗi tích hợp:

- Hiển thị thông báo lỗi khi kết nối server thất bại
- Fallback về alert nếu không có hệ thống notification
- Log lỗi vào console để debug

## Tùy chỉnh

### 1. Thay đổi URL API
```javascript
// Trong file mini-cart.js
updateMiniCartContent() {
    fetch('/your-custom-url/cart/mini', {
        // ...
    })
}
```

### 2. Thay đổi format hiển thị
```javascript
// Trong method updateCartPopupContent()
updateCartPopupContent(data) {
    // Tùy chỉnh HTML template ở đây
}
```

### 3. Thay đổi notification system
```javascript
// Trong method showNotification()
showNotification(message, type) {
    // Tùy chỉnh cách hiển thị thông báo
}
```

## Ví dụ sử dụng hoàn chỉnh

### 1. Form thêm sản phẩm
```html
<form id="add-to-cart-form">
    <input type="hidden" name="product_id" value="1">
    <input type="hidden" name="quantity" value="1">
    <button type="button" onclick="addToCart()">Thêm vào giỏ hàng</button>
</form>

<script>
function addToCart() {
    const form = document.getElementById('add-to-cart-form');
    const formData = new FormData(form);
    
    if (window.miniCartManager) {
        window.miniCartManager.addToCartAndUpdate(formData);
    }
}
</script>
```

### 2. Nút xóa sản phẩm
```html
<button onclick="removeFromCart('1')">Xóa</button>

<script>
function removeFromCart(itemId) {
    if (window.miniCartManager) {
        window.miniCartManager.removeFromCartAndUpdate(itemId);
    }
}
</script>
```

### 3. Input cập nhật số lượng
```html
<input type="number" value="1" onchange="updateQuantity('1', this.value)">

<script>
function updateQuantity(itemId, quantity) {
    if (window.miniCartManager) {
        window.miniCartManager.updateCartQuantityAndUpdate(itemId, quantity);
    }
}
</script>
```

## Lưu ý

1. Đảm bảo CSRF token được set đúng cho Laravel
2. Kiểm tra quyền truy cập API
3. Xử lý lỗi network một cách phù hợp
4. Test trên cả user đăng nhập và guest
5. Đảm bảo responsive design cho mobile

## Troubleshooting

### Lỗi thường gặp

1. **CSRF token mismatch**: Kiểm tra meta tag csrf-token
2. **404 Not Found**: Kiểm tra route `/cart/mini`
3. **500 Server Error**: Kiểm tra method `getMiniCart()` trong CartController
4. **JavaScript Error**: Kiểm tra console browser

### Debug

```javascript
// Bật debug mode
console.log('Mini Cart Manager:', window.miniCartManager);

// Kiểm tra response từ server
fetch('/cart/mini')
    .then(response => response.json())
    .then(data => console.log('Cart data:', data));
``` 