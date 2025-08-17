<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\OrderStatusHistory;

echo "=== KIỂM TRA ẢNH TRONG DATABASE ===\n\n";

// Kiểm tra tất cả status_histories
echo "1. Tất cả status_histories:\n";
$allHistories = OrderStatusHistory::orderBy('created_at', 'desc')->limit(10)->get();
foreach ($allHistories as $h) {
    echo "ID: {$h->id}, Status: {$h->status}, Note: {$h->admin_note}, Image: " . ($h->image_path ?? 'NULL') . "\n";
}

echo "\n2. Status_histories có ảnh:\n";
$historiesWithImage = OrderStatusHistory::whereNotNull('image_path')->get();
echo "Tìm thấy: " . $historiesWithImage->count() . " records có ảnh\n";
foreach ($historiesWithImage as $h) {
    echo "ID: {$h->id}, Status: {$h->status}, Image: {$h->image_path}\n";
}

echo "\n3. Kiểm tra ảnh trong thư mục:\n";
$imageDir = storage_path('app/public/order_images');
if (is_dir($imageDir)) {
    $files = scandir($imageDir);
    $imageFiles = array_filter($files, function($file) {
        return $file !== '.' && $file !== '..';
    });
    echo "Có " . count($imageFiles) . " ảnh trong thư mục:\n";
    foreach ($imageFiles as $file) {
        echo "- {$file}\n";
    }
} else {
    echo "Thư mục không tồn tại: {$imageDir}\n";
}

