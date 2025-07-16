## Setup môi trường
# Bước 1: Tạo file .env từ mẫu & Tạo APP_KEY cho Laravel (chạy 2 lệnh cùng 1 lúc)
cp .env.example .env
php artisan key:generate

# Bước 2: Cập nhật các giá trị trong .env cho đúng máy của bạn
# Ví dụ:
# DB_DATABASE=funori_base
# DB_USERNAME=root
# DB_PASSWORD=

## lưu ý: nên backup file .env đã điền sẵn thông tin để lần sau paste lại cho tiện
