<?php $__env->startSection('title', 'Thống kê đơn hàng'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="mb-24 flex flex-wrap gap20">
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Tổng số đơn hàng</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;"><?php echo e($totalOrders); ?></div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng thành công</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;"><?php echo e($deliveredOrders ?? 0); ?></div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng đã hủy</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;"><?php echo e($cancelledOrders ?? 0); ?></div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng đang xử lý</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;"><?php echo e($processingOrders ?? 0); ?></div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng chờ xác nhận</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;"><?php echo e($pendingOrders ?? 0); ?></div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng trả hàng</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;"><?php echo e($returnedOrders ?? 0); ?></div>
                </div>
            </div>
            <div class="mb-24 flex flex-wrap gap20">
                <div class="wg-box" style="min-width:220px;">
                    <div class="body-title mb-2">Doanh thu tháng <?php echo e(now()->format('m/Y')); ?></div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;"><?php echo e(number_format($totalRevenueMonth, 0, ',', '.')); ?>₫</div>
                </div>
                <div class="wg-box" style="min-width:220px;">
                    <div class="body-title mb-2">Doanh thu năm <?php echo e(now()->format('Y')); ?></div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;"><?php echo e(number_format($totalRevenueYear, 0, ',', '.')); ?>₫</div>
                </div>
                <div class="wg-box" style="min-width:220px;">
                    <div class="body-title mb-2">Doanh thu trung bình/tháng</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">
                        <?php echo e(number_format($avgRevenuePerMonth ?? 0, 0, ',', '.')); ?>₫
                    </div>
                </div>
                <div class="wg-box" style="min-width:220px;">
                    <div class="body-title mb-2">Đơn hàng mới nhất</div>
                    <?php if($latestOrder): ?>
                        <div class="body-title-2">
                            <a href="<?php echo e(route('admin.orders.show', $latestOrder->id)); ?>">#<?php echo e($latestOrder->order_code); ?></a>
                            - <?php echo e($latestOrder->customer_name); ?> (<?php echo e(number_format($latestOrder->total_amount, 0, ',', '.')); ?>₫)
                            <span class="text-tiny ml-2"><?php echo e($latestOrder->ordered_at ? \Carbon\Carbon::parse($latestOrder->ordered_at)->format('d/m/Y H:i') : ''); ?></span>
                        </div>
                    <?php else: ?>
                        <div class="body-title-2">Không có đơn hàng</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mb-24">
                <a href="<?php echo e(route('admin.orders.export', request()->all())); ?>" class="tf-button">
                    <i class="icon-file-text"></i> Xuất Excel/CSV
                </a>
            </div>
            <div class="wg-box mt-6">
                <div class="body-title mb-2">Biểu đồ đơn hàng theo tháng (năm <?php echo e(now()->format('Y')); ?>)</div>
                <canvas id="ordersChart" height="80"></canvas>
            </div>
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Bản quyền © 2024 <a href="https://themesflat.co/html/ecomus/index.html">Ecomus</a>. Thiết kế bởi Themesflat. Đã đăng ký bản quyền.</div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('ordersChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($chartLabels); ?>,
                datasets: [{
                    label: 'Số đơn hàng',
                    data: <?php echo json_encode($chartOrderCounts); ?>,
                    backgroundColor: '#3b82f6'
                },{
                    label: 'Doanh thu (₫)',
                    data: <?php echo json_encode($chartOrderAmounts); ?>,
                    backgroundColor: '#10b981'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/orders/stats.blade.php ENDPATH**/ ?>