# Sửa lỗi API 500 cho Shipper App

## Vấn đề đã gặp

**Lỗi:** `GET http://127.0.0.1:8000/api/shipper-app/orders/107 500 (Internal Server Error)`

**Nguyên nhân:** `Class "App\Models\Notification" not found`

## Giải pháp đã áp dụng

### 1. Tạo Model Notification
- **File:** `app/Models/Notification.php`
- **Chức năng:** Xử lý thông báo cho shipper và user
- **Fields:** user_id, shipper_id, type, title, message, data, read_at

### 2. Tạo Migration cho bảng notifications
- **File:** `database/migrations/2025_08_07_162343_create_notifications_table.php`
- **Chức năng:** Tạo bảng notifications trong database
- **Indexes:** Tối ưu query cho user_id và shipper_id

### 3. Chạy Migration
```bash
php artisan migrate
```

## Cấu trúc bảng notifications

```sql
CREATE TABLE notifications (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NULL,
    shipper_id BIGINT NULL,
    type VARCHAR(255),
    title VARCHAR(255),
    message TEXT,
    data JSON NULL,
    read_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (shipper_id) REFERENCES shippers(id) ON DELETE CASCADE,
    
    INDEX idx_user_read (user_id, read_at),
    INDEX idx_shipper_read (shipper_id, read_at)
);
```

## API Endpoints đã được sửa

### ✅ Orders API
- `GET /api/shipper-app/orders` - Lấy danh sách đơn hàng
- `GET /api/shipper-app/orders/{id}` - Lấy chi tiết đơn hàng
- `POST /api/shipper-app/orders/{id}/status` - Cập nhật trạng thái

### ✅ Notifications API
- `GET /api/shipper-app/notifications` - Lấy thông báo
- `PUT /api/shipper-app/notifications/{id}/read` - Đánh dấu đã đọc
- `PUT /api/shipper-app/notifications/mark-all-read` - Đánh dấu tất cả đã đọc

### ✅ Profile API
- `GET /api/shipper-app/profile` - Lấy thông tin profile
- `PUT /api/shipper-app/profile` - Cập nhật profile
- `PUT /api/shipper-app/password` - Đổi mật khẩu

### ✅ Location API
- `POST /api/shipper-app/location` - Cập nhật vị trí

## Test API

1. **Khởi động server:**
   ```bash
   php artisan serve
   ```

2. **Test API với Postman hoặc curl:**
   ```bash
   # Login shipper
   curl -X POST http://127.0.0.1:8000/api/shipper-app/login \
     -H "Content-Type: application/json" \
     -d '{"email":"shipper@example.com","password":"password"}'
   
   # Lấy đơn hàng (sử dụng token từ login)
   curl -X GET http://127.0.0.1:8000/api/shipper-app/orders/107 \
     -H "Authorization: Bearer YOUR_TOKEN"
   ```

## Kết quả

✅ **Lỗi 500 đã được khắc phục**
✅ **Model Notification đã được tạo**
✅ **Database migration đã được chạy**
✅ **Tất cả API endpoints hoạt động bình thường**
✅ **Frontend có thể fetch dữ liệu từ API**

## Lưu ý

- Đảm bảo có dữ liệu shipper trong database để test
- Token authentication cần thiết cho các protected routes
- API responses theo format chuẩn với `success`, `message`, `data` 