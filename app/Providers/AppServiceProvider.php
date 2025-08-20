<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;
use App\Events\OrderStatusUpdated;
use App\Events\OrderLocationUpdated;
use App\Events\NewOrderCreated;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // WebSocket Event Logging
        $this->setupWebSocketEventLogging();
        
        // Database Query Logging (chỉ trong development)
        if (config('app.debug')) {
            $this->setupDatabaseLogging();
        }
        
        // Performance Monitoring
        $this->setupPerformanceMonitoring();
    }

    /**
     * Setup WebSocket event logging
     */
    private function setupWebSocketEventLogging()
    {
        // Log OrderStatusUpdated events
        Event::listen(OrderStatusUpdated::class, function ($event) {
            Log::info('WebSocket: OrderStatusUpdated event dispatched', [
                'order_id' => $event->order->id,
                'order_code' => $event->order->order_code,
                'previous_status' => $event->previousStatus,
                'new_status' => $event->newStatus,
                'updated_by' => $event->updatedBy,
                'timestamp' => $event->timestamp->toISOString(),
                'channels' => [
                    'admin.orders',
                    'client.orders.' . $event->order->user_id,
                    'shipper.orders',
                    'orders.' . $event->order->id,
                ],
                'memory_usage' => memory_get_usage(true),
                'peak_memory' => memory_get_peak_usage(true),
            ]);
        });

        // Log OrderLocationUpdated events
        Event::listen(OrderLocationUpdated::class, function ($event) {
            Log::info('WebSocket: OrderLocationUpdated event dispatched', [
                'order_id' => $event->order->id,
                'order_code' => $event->order->order_code,
                'latitude' => $event->latitude,
                'longitude' => $event->longitude,
                'address' => $event->address,
                'updated_by' => $event->updatedBy,
                'timestamp' => $event->timestamp->toISOString(),
                'channels' => [
                    'admin.orders',
                    'client.orders.' . $event->order->user_id,
                    'shipper.orders',
                    'orders.' . $event->order->id . '.location',
                ],
                'memory_usage' => memory_get_usage(true),
                'peak_memory' => memory_get_peak_usage(true),
            ]);
        });

        // Log NewOrderCreated events
        Event::listen(NewOrderCreated::class, function ($event) {
            Log::info('WebSocket: NewOrderCreated event dispatched', [
                'order_id' => $event->order->id,
                'order_code' => $event->order->order_code,
                'order_status' => $event->order->order_status,
                'total_amount' => $event->order->total_amount,
                'user_id' => $event->order->user_id,
                'timestamp' => $event->order->created_at->toISOString(),
                'channels' => [
                    'admin.orders',
                    'shipper.orders',
                    'orders.new',
                ],
                'memory_usage' => memory_get_usage(true),
                'peak_memory' => memory_get_peak_usage(true),
            ]);
        });

        // Log failed events
        Event::listen('Illuminate\Broadcasting\Events\BroadcastExceptionOccurred', function ($event) {
            Log::error('WebSocket: Broadcast exception occurred', [
                'exception' => $event->exception->getMessage(),
                'exception_class' => get_class($event->exception),
                'trace' => $event->exception->getTraceAsString(),
                'event_class' => get_class($event->event),
                'timestamp' => now()->toISOString(),
            ]);
        });

        // Log successful broadcasts
        Event::listen('Illuminate\Broadcasting\Events\BroadcastStarted', function ($event) {
            Log::info('WebSocket: Broadcast started', [
                'event_class' => get_class($event->event),
                'channels' => $event->channels,
                'timestamp' => now()->toISOString(),
            ]);
        });

        Event::listen('Illuminate\Broadcasting\Events\BroadcastCompleted', function ($event) {
            Log::info('WebSocket: Broadcast completed', [
                'event_class' => get_class($event->event),
                'channels' => $event->channels,
                'timestamp' => now()->toISOString(),
            ]);
        });
    }

    /**
     * Setup database query logging
     */
    private function setupDatabaseLogging()
    {
        DB::listen(function ($query) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $time = $query->time;

            // Log slow queries (> 100ms)
            if ($time > 100) {
                Log::warning('Slow database query detected', [
                    'sql' => $sql,
                    'bindings' => $bindings,
                    'time_ms' => $time,
                    'connection' => $query->connection->getName(),
                    'timestamp' => now()->toISOString(),
                ]);
            }

            // Log all queries in debug mode
            if (config('app.debug')) {
                Log::debug('Database query executed', [
                    'sql' => $sql,
                    'bindings' => $bindings,
                    'time_ms' => $time,
                    'connection' => $query->connection->getName(),
                ]);
            }
        });
    }

    /**
     * Setup performance monitoring
     */
    private function setupPerformanceMonitoring()
    {
        // Monitor memory usage
        if (function_exists('memory_get_usage')) {
            $memoryUsage = memory_get_usage(true);
            $peakMemory = memory_get_peak_usage(true);
            
            if ($memoryUsage > 100 * 1024 * 1024) { // > 100MB
                Log::warning('High memory usage detected', [
                    'current_memory_mb' => round($memoryUsage / 1024 / 1024, 2),
                    'peak_memory_mb' => round($peakMemory / 1024 / 1024, 2),
                    'memory_limit' => ini_get('memory_limit'),
                    'timestamp' => now()->toISOString(),
                ]);
            }
        }

        // Monitor execution time
        $executionTime = microtime(true) - LARAVEL_START;
        if ($executionTime > 5) { // > 5 seconds
            Log::warning('Slow execution time detected', [
                'execution_time_seconds' => round($executionTime, 2),
                'request_uri' => request()->getRequestUri(),
                'method' => request()->getMethod(),
                'timestamp' => now()->toISOString(),
            ]);
        }
    }
}
