# Giải thích Logic Mã Giảm Giá (Voucher)

## Các trường dữ liệu quan trọng:

### 1. `times_used` (Tổng lượt dùng)
- **Ý nghĩa**: Tổng số lần voucher này đã được sử dụng bởi TẤT CẢ người dùng
- **Ví dụ**: Nếu `times_used = 5`, có nghĩa là voucher này đã được sử dụng 5 lần bởi tất cả người dùng

### 2. `usage_limit_per_voucher` (Giới hạn tổng lượt dùng)
- **Ý nghĩa**: Tổng số lần tối đa voucher này có thể được sử dụng bởi tất cả người dùng
- **Ví dụ**: Nếu `usage_limit_per_voucher = 100`, voucher có thể được sử dụng tối đa 100 lần

### 3. `usage_limit_per_user` (Giới hạn mỗi user)
- **Ý nghĩa**: Số lần tối đa mỗi người dùng có thể sử dụng voucher này
- **Ví dụ**: Nếu `usage_limit_per_user = 2`, mỗi user chỉ có thể sử dụng voucher này tối đa 2 lần

### 4. `user_used_count` (Số lần user đã dùng)
- **Ý nghĩa**: Số lần user hiện tại đã sử dụng voucher này
- **Tính toán**: Đếm từ bảng `Order` với điều kiện `user_id` và `discount_code`

## Logic kiểm tra khi áp dụng voucher:

### Bước 1: Kiểm tra giới hạn tổng lượt dùng
```php
if ($promotion->usage_limit_per_voucher !== null) {
    if ($promotion->times_used >= $promotion->usage_limit_per_voucher) {
        // Voucher đã hết lượt sử dụng tổng cộng
        return error;
    }
}
```

### Bước 2: Kiểm tra giới hạn mỗi user
```php
if (Auth::check() && $promotion->usage_limit_per_user !== null) {
    $userUsedCount = Order::where('user_id', Auth::id())
        ->where('discount_code', $discountCode)
        ->count();
    
    if ($userUsedCount >= $promotion->usage_limit_per_user) {
        // User đã sử dụng hết lượt cho phép
        return error;
    }
}
```

### Bước 3: Tăng số lần sử dụng khi đơn hàng thành công
```php
// Chỉ tăng khi đơn hàng thực sự được tạo thành công
if ($discountCode) {
    $promotion = \App\Models\Promotion::where('code', $discountCode)->first();
    if ($promotion) {
        $promotion->increment('times_used'); // Tăng tổng lượt dùng
    }
}
```

## Ví dụ thực tế:

### Trường hợp 1: Voucher có giới hạn tổng cộng và mỗi user
- `usage_limit_per_voucher = 10` (tổng cộng 10 lượt)
- `usage_limit_per_user = 2` (mỗi user tối đa 2 lượt)
- `times_used = 3` (đã dùng 3 lượt tổng cộng)

**Kết quả**: 
- Còn 7 lượt tổng cộng (10 - 3)
- Mỗi user có thể dùng tối đa 2 lượt

### Trường hợp 2: User đã dùng 2 lần
- User A đã sử dụng voucher này 2 lần
- `user_used_count = 2`
- `usage_limit_per_user = 2`

**Kết quả**: User A không thể sử dụng thêm nữa

### Trường hợp 3: Voucher hết lượt tổng cộng
- `times_used = 10`
- `usage_limit_per_voucher = 10`

**Kết quả**: Không ai có thể sử dụng voucher này nữa

## Lưu ý quan trọng:

1. **`times_used` chỉ tăng khi đơn hàng thành công**, không tăng khi chỉ áp dụng voucher
2. **`user_used_count` được tính từ bảng `Order`**, đảm bảo chỉ đếm những lần thực sự đặt hàng thành công
3. **Hai giới hạn hoạt động độc lập**: Một voucher có thể hết lượt tổng cộng nhưng user vẫn chưa dùng hết lượt cá nhân
4. **Khi quay về giỏ hàng từ checkout, voucher được xóa** để tránh tính sai số lần sử dụng
