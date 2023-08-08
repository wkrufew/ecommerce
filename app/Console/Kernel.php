<?php

namespace App\Console;

use App\Models\Order;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $hora = now()->subDays(2)/* ->subMinute(10) */;
            $orders = Order::where('status', 1)->whereTime('created_at', '<=', $hora)->get();
            foreach ($orders as $order) {
                $items = json_decode($order->content);
                foreach ($items as $item) {
                    increase($item);
                }
                $order->status = 5;
                $order->save();
            }
        })->hourly();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
