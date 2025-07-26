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
        // Ví dụ chạy lệnh mỗi phút
        $schedule->command('orders:update-status')->everyMinute();
    }
}
