<?php $__env->startSection('title', 'Thống kê đơn hàng'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-3">
  
  <div class="mb-4">
    <h2 class="h4">Dashboard Thống kê Đơn hàng</h2>
    <p class="text-muted mb-0">Cập nhật: <?php echo e(\Carbon\Carbon::now()->format('d/m/Y H:i')); ?></p>
  </div>

  
  <div class="row gy-3 gx-2">
    <?php
      $overview = [
        ['title'=>'Tổng đơn hàng',       'value'=>number_format($totalOrders),      'color'=>'text-dark'],
        ['title'=>'Đơn thành công',     'value'=>number_format($deliveredOrders),  'color'=>'text-success'],
        ['title'=>'Đơn đã hủy',         'value'=>number_format($cancelledOrders),  'color'=>'text-danger'],
        ['title'=>'Đang xử lý',         'value'=>number_format($processingOrders),'color'=>'text-warning'],
        ['title'=>'Chờ xác nhận',       'value'=>number_format($pendingOrders),    'color'=>'text-primary'],
        ['title'=>'Đơn trả hàng',       'value'=>number_format($returnedOrders),   'color'=>'text-info'],
      ];
    ?>
    <?php $__currentLoopData = $overview; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body p-3 text-center">
            <div class="small text-uppercase text-muted"><?php echo e($item['title']); ?></div>
            <div class="h5 <?php echo e($item['color']); ?> fw-bold mb-1"><?php echo e($item['value']); ?></div>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  
  <div class="row gy-3 gx-2 mt-3">
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Tỉ lệ thành công</div>
          <div class="h4 text-success fw-bold"><?php echo e($successRate); ?>% </div>
          <div class="small text-muted">(Đã giao / Đã hoàn tất)</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Tỉ lệ hủy đơn</div>
          <div class="h4 text-danger fw-bold"><?php echo e($cancellationRate); ?>% </div>
          <div class="small text-muted">(Đã hủy / Đã hoàn tất)</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Giá trị TB đơn (AOV)</div>
          <div class="h4 text-primary fw-bold"><?php echo e(number_format($averageOrderValue,0,',','.')); ?>₫</div>
          <div class="small text-muted">(Tháng này)</div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="row gy-3 gx-2 mt-3">
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Tăng trưởng MoM</div>
          <div class="h4 fw-bold"><?php echo e($momRevenueGrowth); ?>% </div>
          <canvas id="sparklineChart" height="40"></canvas>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Tăng trưởng YoY</div>
          <div class="h4 fw-bold"><?php echo e($yoyRevenueGrowth); ?>% </div>
          <div class="small text-muted">So cùng kỳ năm trước</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Đơn hàng mới nhất</div>
          <?php if($latestOrder): ?>
            <div class="fw-bold">#<?php echo e($latestOrder->order_code); ?></div>
            <div class="small mb-1"><?php echo e($latestOrder->customer_name); ?></div>
            <div class="text-info fw-bold mb-1"><?php echo e(number_format($latestOrder->total_amount,0,',','.')); ?>₫</div>
            <div class="small text-muted"><?php echo e(\Carbon\Carbon::parse($latestOrder->created_at)->format('d/m/Y H:i')); ?></div>
          <?php else: ?>
            <div class="small text-muted">Chưa có đơn mới</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  
  <div class="row mt-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-3">
          <div class="small text-muted mb-2">Đơn & Doanh thu 12 tháng</div>
          <canvas id="annualChart" height="120"></canvas>
        </div>
      </div>
    </div>
  </div>

  
  <?php if($cancellationRate > 5): ?>
    <div class="alert alert-warning mt-3">
      <strong>Cảnh báo:</strong> Tỉ lệ hủy đơn đang cao (<?php echo e($cancellationRate); ?>%).
    </div>
  <?php endif; ?>
  <?php if($momRevenueGrowth < 0): ?>
    <div class="alert alert-danger mt-2">
      <strong>Chú ý:</strong> Doanh thu MoM giảm <?php echo e(abs($momRevenueGrowth)); ?>%.
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Sparkline
  new Chart(document.getElementById('sparklineChart'), {
    type: 'line',
    data: { labels: <?php echo json_encode($sparklineLabels, 15, 512) ?>, datasets: [{ data: <?php echo json_encode($sparklineData, 15, 512) ?>, fill:false, borderWidth:1, tension:0.4 }] },
    options: { responsive:true, plugins:{legend:{display:false}}, scales:{x:{display:false},y:{display:false}} }
  });

  // Annual Chart
  new Chart(document.getElementById('annualChart'), {
    type:'bar', data:{ labels:<?php echo json_encode($chartLabels, 15, 512) ?>, datasets:[
      { type:'bar',  label:'Số đơn',   data:<?php echo json_encode($chartCounts, 15, 512) ?>,  yAxisID:'A', backgroundColor:'rgba(54,162,235,0.6)' },
      { type:'line', label:'Doanh thu',data:<?php echo json_encode($chartAmounts, 15, 512) ?>, yAxisID:'B', borderWidth:2 }
    ]},
    options:{ responsive:true, scales:{ A:{beginAtZero:true, position:'left'}, B:{beginAtZero:true, position:'right', grid:{drawOnChartArea:false}} } }
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/orders/stats.blade.php ENDPATH**/ ?>