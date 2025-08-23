<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>HÓA ĐƠN #{{ $order->order_code }}</title>
    <style>
        @page {
            margin: 20mm;
        }

        /* Sử dụng font Dejavu Sans để hỗ trợ tốt tiếng Việt khi in ra PDF */
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .invoice-box {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #eee;
            padding: 30px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .company-logo img {
            max-height: 60px;
        }

        .company-info {
            text-align: right;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .info,
        .items,
        .totals,
        .notes {
            margin-bottom: 20px;
        }

        .info div,
        .invoice-meta div {
            margin: 4px 0;
        }

        .items table,
        .totals table {
            width: 100%;
            border-collapse: collapse;
        }

        .items th,
        .items td,
        .totals th,
        .totals td {
            border: 1px solid #eee;
            padding: 8px;
        }

        .items th {
            background: #f5f5f5;
        }

        .totals td {
            text-align: right;
        }

        .totals th {
            text-align: left;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #888;
            font-size: 12px;
        }

        .no-print {
            margin-top: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        @php
            // Nhúng logo dưới dạng base64 để đảm bảo luôn hiển thị khi in
            $logoPath = public_path('images/logo/funori.jpg');
            $logoSrc = '';
            if (file_exists($logoPath)) {
                $logoData = base64_encode(file_get_contents($logoPath));
                $logoSrc = 'data:image/jpeg;base64,' . $logoData;
            }

            // Ánh xạ trạng thái đơn hàng sang tiếng Việt
            $statusLabels = [
                'pending_confirmation' => 'Chờ xác nhận',
                'processing' => 'Đang xử lý',
                'shipped' => 'Đang giao hàng',
                'delivered' => 'Đã giao',
                'cancelled' => 'Đã hủy',
                'returned' => 'Đã trả hàng',
                'pending_cancellation' => 'Chờ hủy',
            ];
            $statusText = $statusLabels[$order->order_status] ?? ucfirst(str_replace('_', ' ', $order->order_status));
        @endphp
        <header>
            <div class="company-logo">
                @if ($logoSrc)
                    <img src="{{ $logoSrc }}" alt="Logo Công ty">
                @endif
            </div>
            <div class="company-info">
                <strong>FUNORI</strong><br>
                Địa chỉ:Tòa nhà FPT Polytechnic, P. Trịnh Văn Bô, Xuân Phương,
                Nam Từ Liêm, Hà Nội 100000, Vietnam<br>
                MST: 0312345678<br>
                ĐT: 1900 1234 | Email: support@funori.com
            </div>
        </header>

        <div class="title">HÓA ĐƠN BÁN HÀNG</div>

        <div class="invoice-meta">
            <div><strong>Mã đơn hàng:</strong> #{{ $order->order_code }}</div>
            <div><strong>Ngày tạo:</strong> {{ $order->ordered_at ? $order->ordered_at->format('d/m/Y H:i') : '-' }}
            </div>
            <div><strong>Phương thức thanh toán:</strong>
                {{ optional($order->paymentMethod)->name ?? ($order->payment_method ?? 'Chưa xác định') }}</div>
            <div><strong>Trạng thái:</strong> {{ $statusText }}</div>
        </div>

        <div class="info">
            <strong>Thông tin khách hàng</strong><br>
            Họ tên: {{ $order->shipping_name ?? '-' }}<br>
            Email: {{ $order->shipping_email ?? '-' }}<br>
            SĐT: {{ $order->shipping_phone ?? '-' }}<br>
            Địa chỉ giao hàng: {{ $order->shipping_address ?? '-' }}
        </div>

        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>SL</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            @php
                                // Xác định giá một cách an toàn. Ưu tiên giá đã lưu trong đơn hàng.
                                // Nếu không có, lấy giá gốc của sản phẩm. Nếu vẫn không có, mặc định là 0.
                                $unitPrice = $item->price ?? (optional($item->product)->regular_price ?? 0);
                                $lineTotal = $item->quantity * $unitPrice;
                            @endphp
                            <td>
                                {{ optional($item->product)->name ?? 'Sản phẩm không tồn tại' }}
                                @if ($unitPrice == 0)
                                    <br><small style="color:red;">(Lỗi: Không tìm thấy giá)</small>
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            {{-- Sửa lỗi: dùng $item->price thay vì $item->unit_price --}}
                            <td>{{ number_format($unitPrice, 0, ',', '.') }} ₫</td>
                            <td>{{ number_format($lineTotal, 0, ',', '.') }} ₫</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="totals">
            <table>
                <tr>
                    <th>Tạm tính:</th>
                    <td>{{ number_format($order->subtotal_amount, 0, ',', '.') }} ₫</td>
                </tr>
                <tr>
                    <th>Phí vận chuyển:</th>
                    <td>{{ number_format($order->shipping_fee, 0, ',', '.') }} ₫</td>
                </tr>
                @if ($order->discount_amount > 0)
                    <tr>
                        <th>Giảm giá:</th>
                        <td>- {{ number_format($order->discount_amount, 0, ',', '.') }} ₫</td>
                    </tr>
                @endif
                <tr>
                    <th>Tổng cộng:</th>
                    <td><strong>{{ number_format($order->total_amount, 0, ',', '.') }} ₫</strong></td>
                </tr>
            </table>
        </div>

        <div class="notes">
            <strong>Ghi chú:</strong> Cảm ơn Quý khách đã mua hàng tại FUNORI. Vui lòng giữ lại hóa đơn để đối chiếu khi
            cần đổi trả.
        </div>

        <div class="footer">
            <button class="no-print" onclick="window.print()">In hóa đơn</button><br>
            <span>Hóa đơn có giá trị pháp lý khi có chữ ký số hoặc dấu mộc của công ty.</span>
        </div>
    </div>
</body>

</html>
