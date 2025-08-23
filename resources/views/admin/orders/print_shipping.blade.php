<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>PHIẾU GIAO HÀNG #{{ $order->order_code }}</title>
    <style>
        @page {
            margin: 20mm;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
            color: #333;
        }

        .shipping-box {
            max-width: 800px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .company-logo img {
            max-height: 50px;
            margin-bottom: 10px;
        }

        .company-info,
        .customer-info {
            width: 48%;
        }

        .company-info strong,
        .customer-info strong {
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        .order-meta {
            text-align: center;
            margin-bottom: 25px;
            color: #555;
        }

        .items table {
            width: 100%;
            border-collapse: collapse;
        }

        .items th,
        .items td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .items th {
            background: #f9f9f9;
            font-weight: bold;
        }

        .items td.center,
        .items th.center {
            text-align: center;
        }

        .notes {
            margin-top: 30px;
            padding: 15px;
            border: 1px dashed #ccc;
            border-radius: 5px;
            background: #fdfdfd;
        }

        .signatures {
            margin-top: 50px;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .signatures div {
            width: 45%;
        }

        .signatures .signature-line {
            border-bottom: 1px solid #333;
            height: 40px;
            margin-top: 40px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #888;
            font-size: 12px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="shipping-box">
        @php
            $logoPath = public_path('images/logo/funori.jpg');
            $logoSrc = '';
            if (file_exists($logoPath)) {
                $logoData = base64_encode(file_get_contents($logoPath));
                $logoSrc = 'data:image/jpeg;base64,' . $logoData;
            }
        @endphp

        <div class="header">
            <div class="company-info">
                <strong>Bên gửi:</strong>
                @if ($logoSrc)
                    <img src="{{ $logoSrc }}" alt="Logo Công ty">
                @endif
                <b>CÔNG TY TNHH FUNORI</b><br>
                Tòa nhà FPT Polytechnic, P. Trịnh Văn Bô, Xuân Phương,
                Nam Từ Liêm, Hà Nội 100000, Vietnam<br>
                SĐT: 1900 1234
            </div>
            <div class="customer-info">
                <strong>Bên nhận:</strong>
                <b>{{ $order->shipping_name ?? ($order->customer_name ?? '-') }}</b><br>
                Địa chỉ: {{ $order->shipping_address ?? '-' }}<br>
                SĐT: {{ $order->shipping_phone ?? ($order->customer_phone ?? '-') }}
            </div>
        </div>

        <div class="title">PHIẾU GIAO HÀNG</div>
        <div class="order-meta">
            Mã đơn hàng: <strong>#{{ $order->order_code }}</strong> |
            Ngày đặt: {{ $order->ordered_at ? $order->ordered_at->format('d/m/Y') : '-' }}
        </div>

        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th class="center">STT</th>
                        <th>Tên sản phẩm</th>
                        <th class="center">Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $index => $item)
                        <tr>
                            <td class="center">{{ $index + 1 }}</td>
                            <td>
                                {{ optional($item->product)->name ?? 'Sản phẩm không tồn tại' }}
                                @php
                                    $variantAttrs = $item->variant_attributes;
                                    if (is_string($variantAttrs)) {
                                        $variantAttrs = json_decode($variantAttrs, true);
                                    }
                                @endphp
                                @if (!empty($variantAttrs) && is_array($variantAttrs))
                                    <br><small style="color:#555;">
                                        @foreach ($variantAttrs as $attr => $val)
                                            <span>{{ $attr }}: {{ $val }}</span>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </small>
                                @elseif($item->product_variant_id && $item->productVariant && isset($item->productVariant->attributeValues))
                                    <br><small style="color:#555;">
                                        @foreach ($item->productVariant->attributeValues as $attrValue)
                                            <span>{{ optional($attrValue->attribute)->name ?? '' }}:
                                                {{ $attrValue->value ?? '' }}</span>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </small>
                                @endif
                            </td>
                            <td class="center">{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($order->customer_note)
            <div class="notes">
                <strong>Ghi chú của khách hàng:</strong>
                <p style="margin: 5px 0 0 0;">{{ $order->customer_note }}</p>
            </div>
        @endif

        <div class="signatures">
            <div class="shipper">
                <strong>Nhân viên giao hàng</strong><br>
                (Ký và ghi rõ họ tên)
                <div class="signature-line"></div>
            </div>
            <div class="receiver">
                <strong>Người nhận hàng</strong><br>
                (Ký và ghi rõ họ tên)
                <div class="signature-line"></div>
            </div>
        </div>

        <div class="footer">
            <button class="no-print" onclick="window.print()">In phiếu giao hàng</button>
            <div>Chúc quý khách nhận hàng thành công!</div>
            <div>Cảm ơn quý khách đã tin tưởng và mua sắm tại Funori!</div>
        </div>
    </div>
</body>

</html>
