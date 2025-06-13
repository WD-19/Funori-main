@extends('admin.layout.admin')
@section('title', 'Thống kê đơn hàng')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="mb-24 flex flex-wrap gap20">
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Tổng số đơn hàng</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">{{ $totalOrders }}</div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng thành công</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">{{ $deliveredOrders ?? 0 }}</div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng đã hủy</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">{{ $cancelledOrders ?? 0 }}</div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng đang xử lý</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">{{ $processingOrders ?? 0 }}</div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng chờ xác nhận</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">{{ $pendingOrders ?? 0 }}</div>
                </div>
                <div class="wg-box" style="min-width:180px;">
                    <div class="body-title mb-2">Đơn hàng trả hàng</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">{{ $returnedOrders ?? 0 }}</div>
                </div>
            </div>
            <div class="mb-24 flex flex-wrap gap20">
                <div class="wg-box" style="min-width:220px;">
                    <div class="body-title mb-2">Doanh thu tháng {{ now()->format('m/Y') }}</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">{{ number_format($totalRevenueMonth, 0, ',', '.') }}₫</div>
                </div>
                <div class="wg-box" style="min-width:220px;">
                    <div class="body-title mb-2">Doanh thu năm {{ now()->format('Y') }}</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">{{ number_format($totalRevenueYear, 0, ',', '.') }}₫</div>
                </div>
                <div class="wg-box" style="min-width:220px;">
                    <div class="body-title mb-2">Doanh thu trung bình/tháng</div>
                    <div class="body-title-2 tf-color-1" style="font-size:22px;">
                        {{ number_format($avgRevenuePerMonth ?? 0, 0, ',', '.') }}₫
                    </div>
                </div>
                <div class="wg-box" style="min-width:220px;">
                    <div class="body-title mb-2">Đơn hàng mới nhất</div>
                    @if($latestOrder)
                        <div class="body-title-2">
                            <a href="{{ route('admin.orders.show', $latestOrder->id) }}">#{{ $latestOrder->order_code }}</a>
                            - {{ $latestOrder->customer_name }} ({{ number_format($latestOrder->total_amount, 0, ',', '.') }}₫)
                            <span class="text-tiny ml-2">{{ $latestOrder->ordered_at ? \Carbon\Carbon::parse($latestOrder->ordered_at)->format('d/m/Y H:i') : '' }}</span>
                        </div>
                    @else
                        <div class="body-title-2">Không có đơn hàng</div>
                    @endif
                </div>
            </div>
            <div class="mb-24">
                <a href="{{ route('admin.orders.export', request()->all()) }}" class="tf-button">
                    <i class="icon-file-text"></i> Xuất Excel/CSV
                </a>
            </div>
            <div class="wg-box mt-6">
                <div class="body-title mb-2">Biểu đồ đơn hàng theo tháng (năm {{ now()->format('Y') }})</div>
                <canvas id="ordersChart" height="80"></canvas>
            </div>
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Bản quyền © 2024 <a href="https://themesflat.co/html/ecomus/index.html">Ecomus</a>. Thiết kế bởi Themesflat. Đã đăng ký bản quyền.</div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('ordersChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Số đơn hàng',
                    data: {!! json_encode($chartOrderCounts) !!},
                    backgroundColor: '#3b82f6'
                },{
                    label: 'Doanh thu (₫)',
                    data: {!! json_encode($chartOrderAmounts) !!},
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
@endpush
