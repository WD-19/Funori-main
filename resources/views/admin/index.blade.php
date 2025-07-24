@extends('admin.layout.admin')

@section('title', 'Dashboard')
@section('content')

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
                        <div class="box-icon-trending up">
                            <i class="icon-trending-up"></i>
                            <div class="body-title number">1.56%</div>
                        </div>
                    </div>
                    <h4>{{ number_format($totalRevenue, 0, ',', '.') }}₫</h4>
                </div>
            </div>
            <div class="dropdown default">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <span class="view-all">
                        {{ $type == 'week' ? 'Tuần' : ($type == 'month' ? 'Tháng' : 'Năm') }}
                        <i class="icon-chevron-down"></i>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="?type=week">Tuần</a></li>
                    <li><a href="?type=month">Tháng</a></li>
                    <li><a href="?type=year">Năm</a></li>
                </ul>
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
                <div class="image type-white">
                    {{-- ...icon SVG giữ nguyên... --}}
                </div>
                <div>
                    <div class="flex gap15 items-center">
                        <div class="body-text mt-2 mb-4">Thống kê đơn hàng</div>
                        <div class="box-icon-trending down">
                            <i class="icon-trending-down"></i>
                            <div class="body-title number">1.56%</div>
                        </div>
                    </div>
                    <h4>{{ $totalOrders }}</h4>
                </div>
            </div>
            <div class="dropdown default">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <span class="view-all">
                        {{ $type == 'week' ? 'Tuần' : ($type == 'month' ? 'Tháng' : 'Năm') }}
                        <i class="icon-chevron-down"></i>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="?type=week">Tuần</a></li>
                    <li><a href="?type=month">Tháng</a></li>
                    <li><a href="?type=year">Năm</a></li>
                </ul>
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
                <div class="image type-white">
                    {{-- ...icon SVG giữ nguyên... --}}
                </div>
                <div>
                    <div class="flex gap9 items-center">
                        <div class="body-text mt-2 mb-4">Thống kê khách hàng</div>
                        <div class="box-icon-trending up color-violet">
                            <i class="icon-trending-up"></i>
                            <div class="body-title number">1.56%</div>
                        </div>
                    </div>
                    <h4>{{ $totalCustomers }}</h4>
                </div>
            </div>
            <div class="dropdown default">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <span class="view-all">
                        {{ $type == 'week' ? 'Tuần' : ($type == 'month' ? 'Tháng' : 'Năm') }}
                        <i class="icon-chevron-down"></i>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="?type=week">Tuần</a></li>
                    <li><a href="?type=month">Tháng</a></li>
                    <li><a href="?type=year">Năm</a></li>
                </ul>
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
                <div class="image type-white">
                    {{-- ...icon SVG giữ nguyên... --}}
                </div>
                <div>
                    <div class="flex gap10 items-center">
                        <div class="body-text mt-2 mb-4">Thống kê đánh giá sản phẩm</div>
                        <div class="box-icon-trending up color-blue">
                            <i class="icon-trending-up"></i>
                            <div class="body-title number">1.56%</div>
                        </div>
                    </div>
                    <h4>{{ $totalReviews }}</h4>
                </div>
            </div>
            <div class="dropdown default">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <span class="view-all">
                        {{ $type == 'week' ? 'Tuần' : ($type == 'month' ? 'Tháng' : 'Năm') }}
                        <i class="icon-chevron-down"></i>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="?type=week">Tuần</a></li>
                    <li><a href="?type=month">Tháng</a></li>
                    <li><a href="?type=year">Năm</a></li>
                </ul>
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
            <h5>Revenue</h5>
            <div class="dropdown default style-box">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <a href="product-list.html" class="view-all">Yearly<i class="icon-chevron-down"></i></a>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0);">Weekly</a>
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
                        <div class="dot t3"></div>
                        <div class="text-tiny">Revenue</div>
                    </div>
                </div>
                <div class="flex items-center gap12">
                    <h4>$37,802</h4>
                    <div class="box-icon-trending up">
                        <i class="icon-trending-up"></i>
                        <div class="body-title number text-grey">0.56%</div>
                    </div>
                </div>
            </div>
            <div>
                <div class="mb-1">
                    <div class="block-legend">
                        <div class="dot t5"></div>
                        <div class="text-tiny">Order</div>
                    </div>
                </div>
                <div class="flex items-center gap12">
                    <h4>$28,305</h4>
                    <div class="box-icon-trending up">
                        <i class="icon-trending-up"></i>
                        <div class="body-title number text-grey">0.56%</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="line-chart-7"></div>
    </div>
    <!-- /Revenue -->
    <div class="flex gap20 flex-wrap-mobile">
        <!-- top-product -->
        <div class="wg-box w-half">
            <div class="flex items-center justify-between">
                <h5>Promotional Sales</h5>
                <div class="dropdown default style-box">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        </div>
        <!-- /top-product -->
        <!-- top-countries -->
        <div class="wg-box w-half">
            <div class="flex items-center justify-between">
                <h5>Top sale</h5>
                <div class="dropdown default style-box">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <ul class="flex flex-column h-full has-divider-line">
                <li class="wg-product">
                    <div class="name flex-grow">
                        <div class="image">
                            <img src="images/products/product-1.jpg" alt="">
                        </div>
                        <div>
                            <div class="title">
                                <a href="#" class="body-text">Neptune Longsleeve</a>
                            </div>
                            <div class="price text-tiny">$138</div>
                        </div>
                    </div>
                    <div class="sale body-text">952 Sales</div>
                </li>
                <li class="wg-product">
                    <div class="name flex-grow">
                        <div class="image">
                            <img src="images/products/product-2.jpg" alt="">
                        </div>
                        <div>
                            <div class="title">
                                <a href="#" class="body-text">Ribbed Tank Top</a>
                            </div>
                            <div class="price text-tiny">$108</div>
                        </div>
                    </div>
                    <div class="sale body-text">952 Sales</div>
                </li>
                <li class="wg-product">
                    <div class="name flex-grow">
                        <div class="image">
                            <img src="images/products/product-3.jpg" alt="">
                        </div>
                        <div>
                            <div class="title">
                                <a href="#" class="body-text">Ribbed modal T-shirt</a>
                            </div>
                            <div class="price text-tiny">$125</div>
                        </div>
                    </div>
                    <div class="sale body-text">902 Sales</div>
                </li>
                <li class="wg-product">
                    <div class="name flex-grow">
                        <div class="image">
                            <img src="images/products/product-4.jpg" alt="">
                        </div>
                        <div>
                            <div class="title">
                                <a href="#" class="body-text">Oversized Motif T-shirt</a>
                            </div>
                            <div class="price text-tiny">$98</div>
                        </div>
                    </div>
                    <div class="sale body-text">882 Sales</div>
                </li>
                <li class="wg-product">
                    <div class="name flex-grow">
                        <div class="image">
                            <img src="images/products/product-5.jpg" alt="">
                        </div>
                        <div>
                            <div class="title">
                                <a href="#" class="body-text">V-neck linen T-shirt</a>
                            </div>
                            <div class="price text-tiny">$158</div>
                        </div>
                    </div>
                    <div class="sale body-text">869 Sales</div>
                </li>
                <li class="wg-product">
                    <div class="name flex-grow">
                        <div class="image">
                            <img src="images/products/product-6.jpg" alt="">
                        </div>
                        <div>
                            <div class="title">
                                <a href="#" class="body-text">Jersey thong body</a>
                            </div>
                            <div class="price text-tiny">$78</div>
                        </div>
                    </div>
                    <div class="sale body-text">833 Sales</div>
                </li>
            </ul>
        </div>
        <!-- /top-countries -->
    </div>
</div>
<div class="tf-section-5">
    <div class="wg-box">
        <div class="flex items-center justify-between">
            <h5>Recent orders</h5>
        </div>
        <div class="wg-table table-recent-orders">
            <ul class="table-title flex gap20 mb-14">
                <li>
                    <div class="body-title text-main-dark">Product</div>
                </li>
                <li>
                    <div class="body-title text-main-dark">Customer</div>
                </li>
                <li>
                    <div class="body-title text-main-dark">Product ID</div>
                </li>
                <li>
                    <div class="body-title text-main-dark">Quantity</div>
                </li>
                <li>
                    <div class="body-title text-main-dark">Price</div>
                </li>
                <li>
                    <div class="body-title text-main-dark">Status</div>
                </li>
            </ul>
            <div class="divider mb-14"></div>
            <ul class="flex flex-column has-divider-line has-line-bot">
                <li class="item wg-product gap20">
                    <div class="name">
                        <div class="image">
                            <img src="images/products/product-1.jpg" alt="">
                        </div>
                        <div class="title mb-0">
                            <a href="#" class="body-text">Oversized Motif T-shirt</a>
                        </div>
                    </div>
                    <div class="body-text text-main-dark mt-4">Leslie Alexander</div>
                    <div class="body-text text-main-dark mt-4">1452</div>
                    <div class="body-text text-main-dark mt-4">X1</div>
                    <div class="body-text text-main-dark mt-4">$138</div>
                    <div>
                        <div class="block-available fw-7">Paid</div>
                    </div>
                </li>
                <li class="item wg-product gap20">
                    <div class="name">
                        <div class="image">
                            <img src="images/products/product-2.jpg" alt="">
                        </div>
                        <div class="title mb-0">
                            <a href="#" class="body-text">Oversized Motif T-shirt</a>
                        </div>
                    </div>
                    <div class="body-text text-main-dark mt-4">Leslie Alexander</div>
                    <div class="body-text text-main-dark mt-4">1452</div>
                    <div class="body-text text-main-dark mt-4">X1</div>
                    <div class="body-text text-main-dark mt-4">$138</div>
                    <div>
                        <div class="block-pending fw-7">Pending</div>
                    </div>
                </li>
                <li class="item wg-product gap20">
                    <div class="name">
                        <div class="image">
                            <img src="images/products/product-3.jpg" alt="">
                        </div>
                        <div class="title mb-0">
                            <a href="#" class="body-text">Oversized Motif T-shirt</a>
                        </div>
                    </div>
                    <div class="body-text text-main-dark mt-4">Leslie Alexander</div>
                    <div class="body-text text-main-dark mt-4">1452</div>
                    <div class="body-text text-main-dark mt-4">X1</div>
                    <div class="body-text text-main-dark mt-4">$138</div>
                    <div>
                        <div class="block-available fw-7">Cancel</div>
                    </div>
                </li>
                <li class="item wg-product gap20">
                    <div class="name">
                        <div class="image">
                            <img src="images/products/product-7.jpg" alt="">
                        </div>
                        <div class="title mb-0">
                            <a href="#" class="body-text">Oversized Motif T-shirt</a>
                        </div>
                    </div>
                    <div class="body-text text-main-dark mt-4">Leslie Alexander</div>
                    <div class="body-text text-main-dark mt-4">1452</div>
                    <div class="body-text text-main-dark mt-4">X1</div>
                    <div class="body-text text-main-dark mt-4">$138</div>
                    <div>
                        <div class="block-published fw-7">Processing</div>
                    </div>
                </li>
                <li class="item wg-product gap20">
                    <div class="name">
                        <div class="image">
                            <img src="images/products/product-4.jpg" alt="">
                        </div>
                        <div class="title mb-0">
                            <a href="#" class="body-text">Oversized Motif T-shirt</a>
                        </div>
                    </div>
                    <div class="body-text text-main-dark mt-4">Leslie Alexander</div>
                    <div class="body-text text-main-dark mt-4">1452</div>
                    <div class="body-text text-main-dark mt-4">X1</div>
                    <div class="body-text text-main-dark mt-4">$138</div>
                    <div>
                        <div class="block-published fw-7">Processing</div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny">Showing 1-5 of 15</div>
            <ul class="wg-pagination">
                <li>
                    <a href="#"><i class="icon-chevron-left"></i></a>
                </li>
                <li>
                    <a href="#">1</a>
                </li>
                <li class="active">
                    <a href="#">2</a>
                </li>
                <li>
                    <a href="#">3</a>
                </li>
                <li>
                    <a href="#"><i class="icon-chevron-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="wg-box">
        <div class="flex items-center justify-between">
            <h5>User Location</h5>
        </div>
        <div class="wrap-usa-vectormap">
            <div id="usa-vectormap"></div>
            <div class="bot">
                <div class="flex items-center justify-between gap20 mb-20">
                    <div class="block-legend">
                        <div class="dot t6"></div>
                        <div class="text-tiny text-surface-2">California <span class="fw-7 text-main-dark">40%</span></div>
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
                        <div class="text-tiny text-surface-2">North Carolina <span class="fw-7 text-main-dark">2%</span></div>
                    </div>
                    <div class="block-legend">
                        <div class="dot t3"></div>
                        <div class="text-tiny text-surface-2">Florida <span class="fw-7 text-main-dark">1.5%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Doanh thu
    new Chart(document.getElementById('revenueChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueChart->pluck('date')) !!},
            datasets: [{
                label: 'Doanh thu',
                data: {!! json_encode($revenueChart->pluck('total')) !!},
                borderColor: '#22C55E',
                backgroundColor: 'rgba(34,197,94,0.1)',
                fill: true,
            }]
        }
    });
    // Đơn hàng
    new Chart(document.getElementById('orderChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode($orderChart->pluck('date')) !!},
            datasets: [{
                label: 'Đơn hàng',
                data: {!! json_encode($orderChart->pluck('total')) !!},
                borderColor: '#FF5200',
                backgroundColor: 'rgba(255,82,0,0.1)',
                fill: true,
            }]
        }
    });
    // Khách hàng
    new Chart(document.getElementById('customerChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode($customerChart->pluck('date')) !!},
            datasets: [{
                label: 'Khách hàng',
                data: {!! json_encode($customerChart->pluck('total')) !!},
                borderColor: '#8F77F3',
                backgroundColor: 'rgba(143,119,243,0.1)',
                fill: true,
            }]
        }
    });
    // Đánh giá sản phẩm
    new Chart(document.getElementById('reviewChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode($reviewChart->pluck('date')) !!},
            datasets: [{
                label: 'Đánh giá',
                data: {!! json_encode($reviewChart->pluck('total')) !!},
                borderColor: '#2377FC',
                backgroundColor: 'rgba(35,119,252,0.1)',
                fill: true,
            }]
        }
    });
</script>
@endsection