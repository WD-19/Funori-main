# Sửa lỗi Vue Router cho Shipper App

## Vấn đề đã gặp

Khi truy cập shipper app, URL thay đổi từ:
- `http://127.0.0.1:8000/shipper-app` 
- Thành: `http://127.0.0.1:8000/` (trang chủ)

**Nguyên nhân:** Vue Router sử dụng `createWebHistory()` mà không có base path.

## Giải pháp đã áp dụng

### Sửa Vue Router Configuration
**File:** `resources/js/shipper-app/router/index.js`

```javascript
// Trước (có vấn đề)
const router = createRouter({
  history: createWebHistory(),
  routes
})

// Sau (đã sửa)
const router = createRouter({
  history: createWebHistory('/shipper-app/'),
  routes
})
```

## Cách hoạt động

### ✅ **Trước khi sửa:**
- Truy cập: `http://127.0.0.1:8000/shipper-app`
- Sau khi navigate: `http://127.0.0.1:8000/` ❌
- Load lại trang: Redirect về client ❌

### ✅ **Sau khi sửa:**
- Truy cập: `http://127.0.0.1:8000/shipper-app`
- Sau khi navigate: `http://127.0.0.1:8000/shipper-app/orders` ✅
- Load lại trang: Vẫn ở shipper app ✅

## Cấu trúc URL hiện tại

### Shipper App Routes
- `http://127.0.0.1:8000/shipper-app/` → Dashboard
- `http://127.0.0.1:8000/shipper-app/orders` → Danh sách đơn hàng
- `http://127.0.0.1:8000/shipper-app/orders/123` → Chi tiết đơn hàng
- `http://127.0.0.1:8000/shipper-app/map` → Bản đồ
- `http://127.0.0.1:8000/shipper-app/profile` → Profile
- `http://127.0.0.1:8000/shipper-app/settings` → Cài đặt

## Test

### 1. Test Navigation
```bash
# Truy cập shipper app
http://127.0.0.1:8000/shipper-app

# Navigate trong app
- Click "Orders" → URL: /shipper-app/orders ✅
- Click "Map" → URL: /shipper-app/map ✅
- Click "Profile" → URL: /shipper-app/profile ✅
```

### 2. Test Load lại trang
```bash
# Load lại trang ở bất kỳ route nào
http://127.0.0.1:8000/shipper-app/orders
# Nhấn F5 → Vẫn ở shipper app ✅
```

### 3. Test Direct URL
```bash
# Truy cập trực tiếp các routes
http://127.0.0.1:8000/shipper-app/orders
http://127.0.0.1:8000/shipper-app/map
http://127.0.0.1:8000/shipper-app/profile
# Tất cả đều hoạt động ✅
```

## Kết quả

✅ **URL luôn giữ prefix `/shipper-app/`**
✅ **Load lại trang không bị redirect**
✅ **Direct URL access hoạt động**
✅ **SPA navigation mượt mà**
✅ **Browser back/forward buttons hoạt động**

## Lưu ý

- Base path `/shipper-app/` phải khớp với Laravel route
- Tất cả sub-routes đều có prefix `/shipper-app/`
- Laravel route `shipper-app/{any}` catch tất cả sub-routes
- Vue Router handle client-side navigation
- Laravel chỉ serve initial page, Vue Router handle routing sau đó 