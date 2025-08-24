@extends('admin.layout.admin')

@section('title', 'Dashboard')
@section('content')
    <style>
        .wg-chart-default {
            background: #fff;
            border-radius: 18px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 24px rgba(35,119,252,0.06);
            padding: 32px 28px 24px 28px;
            margin-bottom: 24px;
            min-width: 260px;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .wg-chart-default .top {
            margin-bottom: 18px;
        }
        .wg-chart-default h4 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }
        .wg-chart-default .body-text {
            font-size: 1.1rem;
        }
        .tf-section-4 {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
        }
        .wg-chart-default .wrap-chart {
            padding-top: 10px;
        }
        /* Dropdown filter đẹp hơn */
        .dashboard-filter-dropdown {
            min-width: 160px;
            margin-bottom: 24px;
        }
        .dashboard-filter-dropdown .dropdown-toggle {
            background: #fff;
            border: 1.5px solid #2377FC;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 700;
            color: #2377FC;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(35,119,252,0.08);
        }
        .dashboard-filter-dropdown .dropdown-menu {
            border-radius: 10px;
            min-width: 160px;
            box-shadow: 0 4px 16px rgba(35,119,252,0.12);
        }
        .dashboard-filter-dropdown .dropdown-item {
            padding: 12px 24px;
            font-size: 1.05rem;
        }
        .dashboard-filter-dropdown .dropdown-item.active,
        .dashboard-filter-dropdown .dropdown-item:active,
        .dashboard-filter-dropdown .dropdown-item:hover {
            background: #2377FC;
            color: #fff;
        }
        #current-type-label {
            font-weight: 700;
            color: #2377FC;
            margin-right: 8px;
            font-size: 1.1rem;
        }
        /* Responsive cho mobile */
        @media (max-width: 900px) {
            .tf-section-4 {
                flex-direction: column;
                gap: 18px;
            }
            .wg-chart-default {
                min-width: unset;
                padding: 20px 10px 16px 10px;
            }
        }
    </style>
    <div class="dropdown default dashboard-filter-dropdown mb-3">
        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span id="current-type-label">Tuần</span>
            <i class="icon-chevron-down"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a href="javascript:void(0);"
                    class="dropdown-item filter-type {{ request('type', 'week') == 'week' ? 'active' : '' }}"
                    data-type="week" data-label="Tuần">
                    <i class="fa fa-calendar-week me-2"></i> Tuần
                </a>
            </li>
            <li>
                <a href="javascript:void(0);"
                    class="dropdown-item filter-type {{ request('type') == 'month' ? 'active' : '' }}" data-type="month"
                    data-label="Tháng">
                    <i class="fa fa-calendar-alt me-2"></i> Tháng
                </a>
            </li>
            <li>
                <a href="javascript:void(0);"
                    class="dropdown-item filter-type {{ request('type') == 'year' ? 'active' : '' }}" data-type="year"
                    data-label="Năm">
                    <i class="fa fa-calendar me-2"></i> Năm
                </a>
            </li>
        </ul>
    </div><br><br>

    <div class="tf-section-4 mb-30">
        <!-- Thống kê doanh thu -->
        <div class="wg-chart-default">
            <div class="top">
                <div class="flex items-center gap14">
                    <div class="image type-white">
                        {{-- ...icon SVG giữ nguyên... --}}
                    </div>
                    <div>
                        <div class="flex gap10 items-center">
                            <div class="body-text mt-2 mb-4">Thống kê doanh thu</div>
                        </div>
                        <h4 id="revenue-amount">{{ number_format($totalRevenue, 0, ',', '.') }}₫</h4>
                    </div>
                </div>

            </div>
            <div class="wrap-chart">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Thống kê đơn hàng -->
        <div class="wg-chart-default">
            <div class="top">
                <div class="flex items-center gap14">
                    <div class="image type-white"></div>
                    <div>
                        <div class="flex gap15 items-center">
                            <div class="body-text mt-2 mb-4">Thống kê đơn hàng</div>
                        </div>
                        <h4 id="order-count">{{ $totalOrders }}</h4>
                    </div>
                </div>

            </div>
            <div class="wrap-chart">
                <canvas id="orderChart"></canvas>
            </div>
        </div>

        <!-- Thống kê khách hàng -->
        <div class="wg-chart-default">
            <div class="top">
                <div class="flex items-center gap14">
                    <div class="image type-white"></div>
                    <div>
                        <div class="flex gap9 items-center">
                            <div class="body-text mt-2 mb-4">Thống kê khách hàng</div>
                        </div>
                        <h4 id="customer-count">{{ $totalCustomers }}</h4>
                    </div>
                </div>

            </div>
            <div class="wrap-chart">
                <canvas id="customerChart"></canvas>
            </div>
        </div>

        <!-- Thống kê đánh giá sản phẩm -->
        <div class="wg-chart-default">
            <div class="top">
                <div class="flex items-center gap14">
                    <div class="image type-white"></div>
                    <div>
                        <div class="flex gap10 items-center">
                            <div class="body-text mt-2 mb-4">Thống kê đánh giá</div>
                        </div>
                        <h4 id="review-count">{{ $totalReviews }}</h4>
                    </div>
                </div>

            </div>
            <div class="wrap-chart">
                <canvas id="reviewChart"></canvas>
            </div>
        </div>
    </div>
    <div class="tf-section-2 mb-30">
        <!-- Revenue -->
        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Thu nhập</h5>

            </div>
            <div class="flex flex-wrap gap40">
                <div>
                    <div class="mb-1">
                        <div class="block-legend">
                            <div class="dot t3"></div>
                            <div class="text-tiny">Doanh thu</div>
                        </div>
                    </div>
                    <div class="flex items-center gap12">
                        <h4 id="summary-revenue">{{ number_format($totalRevenue, 0, ',', '.') }}₫</h4>
                        {{-- Nếu có % tăng trưởng, thêm ở đây --}}
                    </div>
                </div>
                <div>
                    <div class="mb-1">
                        <div class="block-legend">
                            <div class="dot t5"></div>
                            <div class="text-tiny">Đơn hàng</div>
                        </div>
                    </div>
                    <div class="flex items-center gap12">
                        <h4 id="summary-orders">{{ $totalOrders }}</h4>
                    </div>
                </div>
            </div>
            <div>
                <canvas id="line-chart-7"></canvas>
            </div>
        </div>
        <!-- /Revenue -->
        <div class="flex gap20 flex-wrap-mobile">
            <!-- top-product -->
            {{-- <div class="wg-box w-half">
                <div class="flex items-center justify-between">
                    <h5>Promotional Sales</h5>
                    <div class="dropdown default style-box">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <a href="product-list.html" class="view-all">Weekly<i class="icon-chevron-down"></i></a>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="javascript:void(0);">Yearly</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Monthly</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-wrap gap40">
                    <div>
                        <div class="mb-1">
                            <div class="block-legend">
                                <div class="text-tiny">Visitors</div>
                            </div>
                        </div>
                        <div class="flex items-center gap10">
                            <h4>7,802</h4>
                            <div class="box-icon-trending up">
                                <i class="icon-trending-up"></i>
                                <div class="body-title number text-grey">0.56%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="morris-donut-1" class="text-center"></div>
                <div class="flex gap20">
                    <div class="block-legend style-1 w-full">
                        <div class="dot t4"></div>
                        <div class="text-tiny">Social Media</div>
                    </div>
                    <div class="block-legend style-1 w-full">
                        <div class="dot t2"></div>
                        <div class="text-tiny">Website</div>
                    </div>
                    <div class="block-legend style-1 w-full">
                        <div class="dot t3"></div>
                        <div class="text-tiny">Store</div>
                    </div>
                </div>
            </div> --}}
            <!-- /top-product -->
            <!-- top-countries -->
            <div class="wg-box w-half">
                <div class="flex items-center justify-between">
                    <h5>Sản phẩm bán chạy</h5>
                    {{-- <div class="dropdown default style-box">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="view-all">
                                {{ $type == 'week' ? 'Tuần' : ($type == 'month' ? 'Tháng' : 'Năm') }}
                                <i class="icon-chevron-down"></i>
                            </span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="?type=week">Tuần</a></li>
                            <li><a href="?type=month">Tháng</a></li>
                            <li><a href="?type=year">Năm</a></li>
                        </ul>
                    </div> --}}
                </div>
                <ul class="flex flex-column h-full has-divider-line">
                    @foreach($topProducts as $item)
                        @php
                            $variant = $item->productVariant;
                            $product = $item->product;
                            $price = ($variant && isset($variant->price_modifier)) ? ($product->regular_price + $variant->price_modifier) : ($product->regular_price ?? 0);
                            $image = null;
                            if ($variant && $variant->image) {
                                $image = $variant->image->image_url;
                            } elseif ($product->thumbnail) {
                                $image = $product->thumbnail->image_url;
                            } elseif ($product->images && $product->images->count() > 0) {
                                $image = $product->images->first()->image_url;
                            } else {
                                $image = 'images/products/default.jpg';
                            }
                        @endphp
                        <li class="wg-product">
                            <div class="name flex-grow">
                                <div class="image">
                                    <img src="{{ asset($image) }}" alt="">
                                </div>
                                <div>
                                    <div class="title">
                                        <a href="#" class="body-text">
                                            {{ $product->name ?? 'N/A' }}
                                            @if($variant && $variant->name)
                                                <span class="text-tiny text-grey">({{ $variant->name }})</span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="price text-tiny">{{ number_format($price, 0, ',', '.') }}₫</div>
                                </div>
                            </div>
                            <div class="sale body-text">{{ $item->total_sales }} đã bán</div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- /top-countries -->
        </div>
    </div>
    <div class="tf-section-5">
        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Đơn hàng gần đây</h5>
            </div>
            <div class="wg-table table-recent-orders">
                <ul class="table-title flex gap20 mb-14">
                    <li>
                        <div class="body-title text-main-dark">Sản phẩm</div>
                    </li>
                    <li>
                        <div class="body-title text-main-dark">Khách hàng</div>
                    </li>
                    <li>
                        <div class="body-title text-main-dark">Mã SP</div>
                    </li>
                    <li>
                        <div class="body-title text-main-dark">Số lượng</div>
                    </li>
                    <li>
                        <div class="body-title text-main-dark">Giá</div>
                    </li>
                    <li>
                        <div class="body-title text-main-dark">Trạng thái</div>
                    </li>
                </ul>
                <div class="divider mb-14"></div>
                <ul class="flex flex-column has-divider-line has-line-bot">
                    @foreach($recentOrders as $order)
                        @foreach($order->orderItems as $item)
                            @php
                                $product = $item->product;
                                $variant = $item->productVariant;
                                $image = $variant && $variant->image
                                    ? $variant->image->image_url
                                    : ($product->thumbnail?->image_url ?? $product->images->first()?->image_url ?? 'images/products/default.jpg');
                                $price = ($variant && isset($variant->price_modifier))
                                    ? ($product->regular_price + $variant->price_modifier)
                                    : ($product->regular_price ?? 0);
                            @endphp
                            <li class="item wg-product gap20">
                                <div class="name">
                                    <div class="image">
                                        <img src="{{ asset($image) }}" alt="">
                                    </div>
                                    <div class="title mb-0">
                                        <a href="#" class="body-text">
                                            {{ $product->name ?? 'N/A' }}
                                            @if($variant && $variant->name)
                                                <span class="text-tiny text-grey">({{ $variant->name }})</span>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="body-text text-main-dark mt-4">{{ $order->user?->full_name ?? $order->customer_name ?? 'Khách vãng lai' }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $product->id ?? '' }}</div>
                                <div class="body-text text-main-dark mt-4">x{{ $item->quantity }}</div>
                                <div class="body-text text-main-dark mt-4">{{ number_format($price, 0, ',', '.') }}₫</div>
                                <div>
                                    @php
                                        $status = $order->order_status;
                                        $statusClass = match ($status) {
                                            'delivered' => 'block-available fw-7',
                                            'pending' => 'block-pending fw-7',
                                            'processing' => 'block-published fw-7',
                                            'cancelled' => 'block-cancel fw-7',
                                            default => 'block-published fw-7'
                                        };
                                    @endphp
                                    <div class="{{ $statusClass }}">
                                        {{ ucfirst($status) }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
            <div class="flex items-center justify-between flex-wrap gap10">
                <div></div>
                <div style="float: right" class="mt-3 custom-pagination">
                    {{ $recentOrders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        {{-- <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>User Location</h5>
            </div>
            <div class="wrap-usa-vectormap">
                <div id="usa-vectormap"></div>
                <div class="bot">
                    <div class="flex items-center justify-between gap20 mb-20">
                        <div class="block-legend">
                            <div class="dot t6"></div>
                            <div class="text-tiny text-surface-2">California <span class="fw-7 text-main-dark">40%</span>
                            </div>
                        </div>
                        <div class="block-legend">
                            <div class="dot t6"></div>
                            <div class="text-tiny text-surface-2">Arizona <span class="fw-7 text-main-dark">15%</span></div>
                        </div>
                        <div class="block-legend">
                            <div class="dot t3"></div>
                            <div class="text-tiny text-surface-2">Texas <span class="fw-7 text-main-dark">10%</span></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap20">
                        <div class="block-legend">
                            <div class="dot t3"></div>
                            <div class="text-tiny text-surface-2">Georda <span class="fw-7 text-main-dark">3.5%</span></div>
                        </div>
                        <div class="block-legend">
                            <div class="dot t3"></div>
                            <div class="text-tiny text-surface-2">North Carolina <span class="fw-7 text-main-dark">2%</span>
                            </div>
                        </div>
                        <div class="block-legend">
                            <div class="dot t3"></div>
                            <div class="text-tiny text-surface-2">Florida <span class="fw-7 text-main-dark">1.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Hàm tạo gradient cho chart
        function getGradient(ctx, color1, color2) {
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, color1);
            gradient.addColorStop(1, color2);
            return gradient;
        }

        // Doanh thu
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($revenueChart->pluck('date')) !!},
                datasets: [{
                    label: 'Doanh thu',
                    data: {!! json_encode($revenueChart->pluck('total')) !!},
                    borderColor: '#22C55E',
                    backgroundColor: getGradient(revenueCtx, 'rgba(34,197,94,0.18)', 'rgba(34,197,94,0.01)'),
                    fill: true,
                    tension: 0.65, // tăng độ cong cho gợn sóng
                    pointRadius: 0, // ẩn điểm
                    pointHoverRadius: 6,
                    borderWidth: 4,
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#22C55E',
                        bodyColor: '#333',
                        borderColor: '#22C55E',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#888', font: { weight: 'bold' } }
                    },
                    y: {
                        grid: { color: '#e0e0e0', borderDash: [4, 4] },
                        ticks: { color: '#888', font: { weight: 'bold' } }
                    }
                }
            }
        });

        // Đơn hàng
        const orderCtx = document.getElementById('orderChart').getContext('2d');
        new Chart(orderCtx, {
            type: 'line', // đổi từ 'bar' sang 'line'
            data: {
                labels: {!! json_encode($orderChart->pluck('date')) !!},
                datasets: [{
                    label: 'Đơn hàng',
                    data: {!! json_encode($orderChart->pluck('total')) !!},
                    borderColor: '#FF5200',
                    backgroundColor: getGradient(orderCtx, 'rgba(255,82,0,0.18)', 'rgba(255,82,0,0.01)'),
                    fill: true,
                    tension: 0.65, // gợn sóng
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    borderWidth: 4,
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#FF5200',
                        bodyColor: '#333',
                        borderColor: '#FF5200',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#888', font: { weight: 'bold' } }
                    },
                    y: {
                        grid: { color: '#e0e0e0', borderDash: [4, 4] },
                        ticks: { color: '#888', font: { weight: 'bold' } }
                    }
                }
            }
        });

        // Khách hàng
        const customerCtx = document.getElementById('customerChart').getContext('2d');
        new Chart(customerCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($customerChart->pluck('date')) !!},
                datasets: [{
                    label: 'Khách hàng',
                    data: {!! json_encode($customerChart->pluck('total')) !!},
                    borderColor: '#8F77F3',
                    backgroundColor: getGradient(customerCtx, 'rgba(143,119,243,0.25)', 'rgba(143,119,243,0.02)'),
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#8F77F3',
                    pointHoverRadius: 8,
                    borderWidth: 3,
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#8F77F3',
                        bodyColor: '#333',
                        borderColor: '#8F77F3',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#888', font: { weight: 'bold' } }
                    },
                    y: {
                        grid: { color: '#e0e0e0', borderDash: [4, 4] },
                        ticks: { color: '#888', font: { weight: 'bold' } }
                    }
                }
            }
        });

        // Đánh giá sản phẩm
        const reviewCtx = document.getElementById('reviewChart').getContext('2d');
        new Chart(reviewCtx, {
            type: 'line', // đổi từ 'bar' sang 'line'
            data: {
                labels: {!! json_encode($reviewChart->pluck('date')) !!},
                datasets: [{
                    label: 'Đánh giá',
                    data: {!! json_encode($reviewChart->pluck('total')) !!},
                    borderColor: '#2377FC',
                    backgroundColor: getGradient(reviewCtx, 'rgba(35,119,252,0.18)', 'rgba(35,119,252,0.01)'),
                    fill: true,
                    tension: 0.65, // gợn sóng
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    borderWidth: 4,
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#2377FC',
                        bodyColor: '#333',
                        borderColor: '#2377FC',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#888', font: { weight: 'bold' } }
                    },
                    y: {
                        grid: { color: '#e0e0e0', borderDash: [4, 4] },
                        ticks: { color: '#888', font: { weight: 'bold' } }
                    }
                }
            }
        });
    </script>
    <script>
        // Biểu đồ doanh thu và đơn hàng trên cùng 1 chart
        new Chart(document.getElementById('line-chart-7').getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($revenueChart->pluck('date')) !!},
                datasets: [
                    {
                        label: 'Doanh thu',
                        data: {!! json_encode($revenueChart->pluck('total')) !!},
                        borderColor: '#22C55E',
                        backgroundColor: 'rgba(34,197,94,0.1)',
                        fill: true,
                        yAxisID: 'y',
                    },
                    {
                        label: 'Đơn hàng',
                        data: {!! json_encode($orderChart->pluck('total')) !!},
                        borderColor: '#FF5200',
                        backgroundColor: 'rgba(255,82,0,0.1)',
                        fill: true,
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: { display: true, text: 'Doanh thu' }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        title: { display: true, text: 'Đơn hàng' }
                    }
                }
            }
        });
    </script>
    <script>
        const getChartInstance = id => Chart.getChart(document.getElementById(id));

        $('.filter-type').on('click', function () {
            const type = $(this).data('type');
            const label = $(this).data('label');
            $('#current-type-label').text(label);

            $.ajax({
                url: '{{ route("admin.dashboard.data") }}',
                type: 'GET',
                data: { type },
                success: function (res) {
                    // Cập nhật số liệu tổng quan
                    $('#revenue-amount').text(res.totalRevenue + '₫');
                    $('#order-count').text(res.totalOrders);
                    $('#customer-count').text(res.totalCustomers);
                    $('#review-count').text(res.totalReviews);
                    // Cập nhật số liệu dưới bảng thu nhập
                    $('#summary-revenue').text(res.totalRevenue + '₫');
                    $('#summary-orders').text(res.totalOrders);

                    // Hàm cập nhật chart đơn (1 dataset)
                    const updateChart = (id, data) => {
                        const chart = getChartInstance(id);
                        chart.data.labels = data.map(i => i.date);
                        chart.data.datasets[0].data = data.map(i => i.total);
                        chart.update();
                    };

                    updateChart('revenueChart', res.revenueChart);
                    updateChart('orderChart', res.orderChart);
                    updateChart('customerChart', res.customerChart);
                    updateChart('reviewChart', res.reviewChart);

                    // Cập nhật biểu đồ thu nhập tổng hợp (2 dataset: doanh thu + đơn hàng)
                    const chart7 = getChartInstance('line-chart-7');
                    chart7.data.labels = res.revenueChart.map(i => i.date);
                    if (chart7.data.datasets.length > 0) {
                        chart7.data.datasets[0].data = res.revenueChart.map(i => i.total);
                    }
                    if (chart7.data.datasets.length > 1) {
                        chart7.data.datasets[1].data = res.orderChart.map(i => i.total);
                    }
                    chart7.update();
                },
                error: function () {
                    alert('Đã xảy ra lỗi khi tải dữ liệu.');
                }
            });
        });
    </script>
@endsection