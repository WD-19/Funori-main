# Hướng dẫn truy cập Shipper App

## Vấn đề đã gặp

Khi truy cập `http://127.0.0.1:8000/` (trang chủ) và load lại trang, nó redirect về trang chủ client thay vì giữ nguyên shipper app.

## Giải pháp đã áp dụng

### 1. Thêm route riêng cho shipper app
```php
// Route cho shipper app ở trang chủ
Route::get('/shipper', function () {
    return redirect()->route('shipper-app');
})->name('shipper');
```

### 2. Cải thiện route trang chủ
```php
Route::get('/', function () {
    // Nếu có query parameter shipper=1 thì redirect về shipper app
    if (request()->has('shipper') || request()->is('shipper*')) {
        return redirect()->route('shipper-app');
    }
    // ... rest of the logic
});
```

## Cách truy cập Shipper App

### ✅ **Cách 1: Truy cập trực tiếp (Khuyến nghị)**
```
http://127.0.0.1:8000/shipper-app
```

### ✅ **Cách 2: Qua route redirect**
```
http://127.0.0.1:8000/shipper
```

### ✅ **Cách 3: Với query parameter**
```
http://127.0.0.1:8000/?shipper=1
```

## Routes hiện tại

### Shipper App Routes
- `GET /shipper-app` → Shipper App Home
- `GET /shipper-app/{any}` → Shipper App (SPA)
- `GET /shipper` → Redirect to Shipper App
- `GET /ws/shipper` → WebSocket endpoint

### API Routes
- `POST /api/shipper-app/login` → Login shipper
- `GET /api/shipper-app/orders` → Lấy danh sách đơn hàng
- `GET /api/shipper-app/orders/{id}` → Lấy chi tiết đơn hàng
- `POST /api/shipper-app/orders/{id}/status` → Cập nhật trạng thái

## Test

### 1. Test truy cập trực tiếp
```bash
# Truy cập shipper app
http://127.0.0.1:8000/shipper-app

# Load lại trang (F5) - không bị redirect ✅
```

### 2. Test qua redirect
```bash
# Truy cập qua redirect
http://127.0.0.1:8000/shipper

# Sẽ tự động redirect về shipper-app ✅
```

### 3. Test với query parameter
```bash
# Truy cập với query parameter
http://127.0.0.1:8000/?shipper=1

# Sẽ redirect về shipper-app ✅
```

## Kết quả

✅ **Shipper app có thể truy cập qua nhiều cách**
✅ **Không bị redirect về client khi load lại trang**
✅ **SPA routing hoạt động đúng**
✅ **WebSocket và API hoạt động bình thường**

## Lưu ý

- **Khuyến nghị sử dụng:** `http://127.0.0.1:8000/shipper-app`
- Shipper app sử dụng SPA nên có thể navigate trong app mà không cần reload
- Tất cả sub-routes đều được handle bởi Vue Router
- API endpoints cần authentication token để truy cập 