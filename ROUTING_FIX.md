# Sửa lỗi Routing cho Shipper App

## Vấn đề đã gặp

### 1. **Load lại trang shipper app → về trang chủ client**
- **Nguyên nhân:** Route `/` redirect tất cả về client dashboard
- **Giải pháp:** Thêm kiểm tra shipper-app trước khi redirect

### 2. **Xem chi tiết shipper → 404**
- **Nguyên nhân:** Route không tồn tại hoặc conflict
- **Giải pháp:** Thêm route và method cho showDetails

## Giải pháp đã áp dụng

### 1. Sửa Route Chính
**File:** `routes/web.php`

```php
Route::get('/', function () {
    // Kiểm tra nếu đang truy cập shipper app thì không redirect
    if (request()->is('shipper-app*')) {
        return redirect()->route('shipper-app');
    }
    
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('client.dashboard');
    }
    return redirect()->route('client.home');
});
```

### 2. Thêm Route Shipper Details
**File:** `routes/web.php`

```php
// Quản lý shipper
Route::prefix('shippers')->name('shippers.')->group(function () {
    // ... existing routes ...
    
    // Xem chi tiết shipper
    Route::get('/{shipper}/details', [ShipperController::class, 'showDetails'])->name('details');
});
```

### 3. Thêm Method showDetails
**File:** `app/Http/Controllers/Admin/ShipperController.php`

```php
/**
 * Hiển thị chi tiết shipper (alias cho show)
 */
public function showDetails(Shipper $shipper)
{
    return $this->show($shipper);
}
```

## Cấu trúc Routes hiện tại

### ✅ Shipper App Routes
- `GET /shipper-app` → Shipper App Home
- `GET /shipper-app/{any}` → Shipper App (SPA)
- `GET /ws/shipper` → WebSocket endpoint

### ✅ Admin Shipper Routes
- `GET /admin/shippers` → Danh sách shipper
- `GET /admin/shippers/{shipper}` → Chi tiết shipper
- `GET /admin/shippers/{shipper}/details` → Chi tiết shipper (alias)
- `GET /admin/shippers/{shipper}/edit` → Edit shipper
- `POST /admin/shippers` → Tạo shipper
- `PUT /admin/shippers/{shipper}` → Cập nhật shipper
- `DELETE /admin/shippers/{shipper}` → Xóa shipper

## Test

### 1. Test Shipper App Routing
```bash
# Truy cập shipper app
http://127.0.0.1:8000/shipper-app

# Load lại trang (F5) - không bị redirect về client
http://127.0.0.1:8000/shipper-app/orders
```

### 2. Test Shipper Details
```bash
# Truy cập chi tiết shipper (thay {id} bằng ID thực)
http://127.0.0.1:8000/admin/shippers/{id}
http://127.0.0.1:8000/admin/shippers/{id}/details
```

## Kết quả

✅ **Shipper app không bị redirect khi load lại trang**
✅ **Route chi tiết shipper hoạt động bình thường**
✅ **SPA routing hoạt động đúng**
✅ **Admin có thể xem chi tiết shipper**

## Lưu ý

- Shipper app sử dụng SPA (Single Page Application)
- Route `/shipper-app/{any}` catch tất cả sub-routes
- Admin routes có prefix `/admin` để tránh conflict
- WebSocket route riêng biệt cho real-time updates 