@extends('client.profile.index')

@section('profile_content')
                @php
                    $tabs = [
                        'all' => 'Tất cả',
                        'pending' => 'Chờ thanh toán',
                        'shipping' => 'Vận chuyển',
                        'delivering' => 'Chờ giao hàng',
                        'completed' => 'Hoàn thành',
                        'returned' => 'Trả hàng/Hoàn tiền',
                        'cancelled' => 'Đã huỷ',
                    ];
                    $activeTab = request('tab', 'all');
                @endphp
                <ul class="nav nav-tabs mb-3 border-0 d-flex flex-nowrap" style="background: #fafbfc;">
                    @foreach($tabs as $key => $label)
                        <li class="nav-item" style="flex: 0.13; min-width: 0;">
                            <a class="nav-link fw-bold text-center {{ $activeTab == $key ? 'active custom-active' : '' }}"
                               href="?tab={{ $key }}"
                               style="font-size: 13px; padding: 12px 16px; color: {{ $activeTab == $key ? '#f44336' : '#222' }}; border: none; background: none; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <style>
                    .nav-tabs .nav-item {
                        min-width: 0;
                        flex: 1;
                    }
                    .nav-tabs .nav-link.custom-active {
                        color: #f44336 !important;
                        border-bottom: 3px solid #f44336 !important;
                        background: #fff !important;
                    }
                    .nav-tabs .nav-link {
                        border: none !important;
                        background: none !important;
                        transition: color 0.2s;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        text-align: center;
                    }
                    @media (max-width: 768px) {
                        .nav-tabs .nav-link {
                            font-size: 13px;
                            padding: 8px 10px;
                        }
                    }
                </style>
                
                <div class="d-flex flex-column align-items-center justify-content-center py-5" style="min-height: 300px;">
                    <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/order/7c6394a2c5b6c2c3c6c5.svg" alt="empty" style="width: 80px; height: 80px;">
                    <div class="mt-3" style="font-size: 18px; color: #222;">Chưa có đơn hàng</div>
                </div>
            </div>
@endsection