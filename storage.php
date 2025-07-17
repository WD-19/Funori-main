php artisan route:clear
php artisan config:clear
php artisan view:clear

=====================================================================================

php artisan tinker

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Tạo token
$plainToken = Str::random(64);
$hashedToken = Hash::make($plainToken);

// Thêm vào DB
DB::table('password_reset_tokens')->insert([
'email' => 'demo@gmail.com',
'token' => $hashedToken,
'created_at' => now()
]);

// In ra token dùng để test
$plainToken

=====================================================================================

🔧 Các bước:
A. Bật xác minh 2 bước cho Gmail (nếu chưa bật):
Truy cập: https://myaccount.google.com/security

Bật Xác minh 2 bước (Two-factor Authentication)

B. Tạo App Password:
Vào: https://myaccount.google.com/apppasswords

Chọn:

App: Mail

Device: Other → Laravel

Nhấn Generate

Bạn sẽ được cấp 1 mã 16 ký tự: abcd efgh ijkl mnop

→ Đây là mật khẩu bạn dán vào .env

VD:
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=phamdat7905@gmail.com
MAIL_PASSWORD="vcfh vwjl xrhp hshm"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=phamdat7905@gmail.com
MAIL_FROM_NAME="funori-reset-password"

=====================================================================================
