@extends('admin.layout.admin')
@section('title', 'Thống kê đơn hàng')

@section('content')
<div class="container py-3">
  {{-- Tiêu đề trang --}}
  <div class="mb-4">
    <h2 class="h4">Dashboard Thống kê Đơn hàng</h2>
    <p class="text-muted mb-0">Cập nhật: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
  </div>

  {{-- 1. KPI Tổng quan --}}
  <div class="row gy-3 gx-2">
    @php
      $overview = [
        ['title'=>'Tổng đơn hàng',       'value'=>number_format($totalOrders),      'color'=>'text-dark'],
        ['title'=>'Đơn thành công',     'value'=>number_format($deliveredOrders),  'color'=>'text-success'],
        ['title'=>'Đơn đã hủy',         'value'=>number_format($cancelledOrders),  'color'=>'text-danger'],
        ['title'=>'Đang xử lý',         'value'=>number_format($processingOrders),'color'=>'text-warning'],
        ['title'=>'Chờ xác nhận',       'value'=>number_format($pendingOrders),    'color'=>'text-primary'],
        ['title'=>'Đơn trả hàng',       'value'=>number_format($returnedOrders),   'color'=>'text-info'],
      ];
    @endphp
    @foreach($overview as $item)
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body p-3 text-center">
            <div class="small text-uppercase text-muted">{{ $item['title'] }}</div>
            <div class="h5 {{ $item['color'] }} fw-bold mb-1">{{ $item['value'] }}</div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- 2. KPI Hiệu suất --}}
  <div class="row gy-3 gx-2 mt-3">
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Tỉ lệ thành công</div>
          <div class="h4 text-success fw-bold">{{ $successRate }}% </div>
          <div class="small text-muted">(Đã giao / Đã hoàn tất)</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Tỉ lệ hủy đơn</div>
          <div class="h4 text-danger fw-bold">{{ $cancellationRate }}% </div>
          <div class="small text-muted">(Đã hủy / Đã hoàn tất)</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Giá trị TB đơn (AOV)</div>
          <div class="h4 text-primary fw-bold">{{ number_format($averageOrderValue,0,',','.') }}₫</div>
          <div class="small text-muted">(Tháng này)</div>
        </div>
      </div>
    </div>
  </div>

  {{-- 3. Growth và Đơn mới nhất --}}
  <div class="row gy-3 gx-2 mt-3">
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Tăng trưởng MoM</div>
          <div class="h4 fw-bold">{{ $momRevenueGrowth }}% </div>
          <canvas id="sparklineChart" height="40"></canvas>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Tăng trưởng YoY</div>
          <div class="h4 fw-bold">{{ $yoyRevenueGrowth }}% </div>
          <div class="small text-muted">So cùng kỳ năm trước</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-3">
          <div class="small text-muted">Đơn hàng mới nhất</div>
          @if($latestOrder)
            <div class="fw-bold">#{{ $latestOrder->order_code }}</div>
            <div class="small mb-1">{{ $latestOrder->customer_name }}</div>
            <div class="text-info fw-bold mb-1">{{ number_format($latestOrder->total_amount,0,',','.') }}₫</div>
            <div class="small text-muted">{{ \Carbon\Carbon::parse($latestOrder->created_at)->format('d/m/Y H:i') }}</div>
          @else
            <div class="small text-muted">Chưa có đơn mới</div>
          @endif
        </div>
      </div>
    </div>
  </div>

  {{-- 4. Biểu đồ 12 tháng --}}
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

  {{-- 5. Alert --}}
  @if($cancellationRate > 5)
    <div class="alert alert-warning mt-3">
      <strong>Cảnh báo:</strong> Tỉ lệ hủy đơn đang cao ({{ $cancellationRate }}%).
    </div>
  @endif
  @if($momRevenueGrowth < 0)
    <div class="alert alert-danger mt-2">
      <strong>Chú ý:</strong> Doanh thu MoM giảm {{ abs($momRevenueGrowth) }}%.
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Sparkline
  new Chart(document.getElementById('sparklineChart'), {
    type: 'line',
    data: { labels: @json($sparklineLabels), datasets: [{ data: @json($sparklineData), fill:false, borderWidth:1, tension:0.4 }] },
    options: { responsive:true, plugins:{legend:{display:false}}, scales:{x:{display:false},y:{display:false}} }
  });

  // Annual Chart
  new Chart(document.getElementById('annualChart'), {
    type:'bar', data:{ labels:@json($chartLabels), datasets:[
      { type:'bar',  label:'Số đơn',   data:@json($chartCounts),  yAxisID:'A', backgroundColor:'rgba(54,162,235,0.6)' },
      { type:'line', label:'Doanh thu',data:@json($chartAmounts), yAxisID:'B', borderWidth:2 }
    ]},
    options:{ responsive:true, scales:{ A:{beginAtZero:true, position:'left'}, B:{beginAtZero:true, position:'right', grid:{drawOnChartArea:false}} } }
  });
</script>
@endpush
