<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Đăng ký các lệnh Artisan
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }

    /**
     * Lên lịch các tác vụ Artisan
     */
    protected function schedule(Schedule $schedule)
    {
        // ✅ Thay đổi từ 30 phút thành 1 phút để test nhanh
        $schedule->command('refunds:process-pending')
            ->everyMinute()  // Chạy mỗi phút thay vì 30 phút
            ->withoutOverlapping()
            ->runInBackground();
    }
}
