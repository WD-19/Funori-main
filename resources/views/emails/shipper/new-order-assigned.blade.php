<!DOCTYPE html>
<html lang="vi">
<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>Đơn hàng mới được phân</title>
</head>
<body style="margin:0;padding:0;background:#f5f7fa;font-family:Arial,Helvetica,sans-serif;line-height:1.5;color:#1f2937;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f5f7fa;padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="640" cellpadding="0" cellspacing="0" style="max-width:640px;width:100%;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;box-shadow:0 2px 6px rgba(0,0,0,0.06);">
                    <!-- Header -->
                    <tr>
                        <td style="background:linear-gradient(90deg,#2563eb,#4f46e5);padding:20px 28px;">
                            <h1 style="margin:0;font-size:20px;font-weight:600;color:#ffffff;letter-spacing:0.5px;">ĐƠN HÀNG MỚI</h1>
                            <p style="margin:6px 0 0;font-size:13px;color:rgba(255,255,255,0.9);">Bạn vừa được phân một đơn hàng mới – xử lý ngay nhé!</p>
                        </td>
                    </tr>
                    <!-- Body -->
                    <tr>
                        <td style="padding:28px 32px 8px;">
                            <p style="margin:0 0 16px;font-size:15px;">Xin chào <strong style="color:#111827;">{{ $shipper->name }}</strong>,</p>
                            <p style="margin:0 0 20px;font-size:14px;color:#374151;">Bạn có một đơn hàng mới cần được xử lý. Vui lòng kiểm tra thông tin dưới đây và vào ứng dụng để <strong>Nhận</strong> hoặc <strong>Từ chối</strong> đơn sớm.</p>

                            <!-- Order Summary Card -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;background:#f9fafb;margin:0 0 28px;">
                                <tr>
                                    <td style="padding:18px 22px;">
                                        <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.5px;color:#6b7280;margin-bottom:8px;">Thông tin đơn</div>
                                        <div style="display:flex;flex-wrap:wrap;gap:12px;margin:0 0 14px;">
                                            <span style="background:#eef2ff;color:#4338ca;font-size:12px;font-weight:600;padding:4px 10px;border-radius:999px;">#{{ $order->order_code }}</span>
                                              <span style="background:#ecfdf5;color:#047857;font-size:12px;font-weight:600;padding:4px 10px;border-radius:999px;">Tổng: {{ number_format((float) $order->total_amount, 0, ',', '.') }} đ</span>
                                        </div>
                                        <table width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;line-height:1.4;">
                                            <tr>
                                                <td style="padding:6px 0;width:140px;color:#6b7280;">Khách hàng:</td>
                                                <td style="padding:6px 0;font-weight:600;color:#111827;">{{ $order->customer_name ?? $order->buyer_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0;color:#6b7280;">Địa chỉ giao:</td>
                                                <td style="padding:6px 0;color:#111827;">{{ $order->shipping_address }}</td>
                                            </tr>
                                            @if(!empty($order->shipping_phone))
                                            <tr>
                                                <td style="padding:6px 0;color:#6b7280;">SĐT:</td>
                                                <td style="padding:6px 0;color:#111827;">{{ $order->shipping_phone }}</td>
                                            </tr>
                                            @endif
                                            @if(!empty($order->payment_method) || !empty($order->paymentMethod?->name))
                                            <tr>
                                                <td style="padding:6px 0;color:#6b7280;">Thanh toán:</td>
                                                <td style="padding:6px 0;color:#111827;">{{ $order->payment_method ?? ($order->paymentMethod->name ?? 'Tiền mặt') }}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Action Button -->
                            <div style="text-align:center;margin:0 0 32px;">
                                <a href="{{ config('app.url') }}/shipper" target="_blank" style="display:inline-block;background:#2563eb;color:#ffffff;text-decoration:none;font-weight:600;font-size:14px;padding:14px 26px;border-radius:8px;box-shadow:0 4px 10px rgba(37,99,235,0.25);">MỞ ỨNG DỤNG SHIPPER</a>
                                <div style="font-size:11px;color:#6b7280;margin-top:10px;">(Nếu nút không hoạt động, hãy truy cập: {{ config('app.url') }}/shipper)</div>
                            </div>

                            <!-- Tips / Note -->
                            <div style="background:#fff7ed;border:1px solid #fed7aa;padding:14px 16px;border-radius:8px;font-size:13px;color:#92400e;margin-bottom:8px;">
                                💡 <strong>Lưu ý:</strong> Hãy phản hồi sớm để tránh đơn bị chuyển cho shipper khác.
                            </div>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="padding:20px 28px 28px;">
                            <p style="margin:0 0 4px;font-size:12px;color:#6b7280;">Email này được gửi tự động – vui lòng không trả lời trực tiếp.</p>
                            <p style="margin:0;font-size:12px;color:#9ca3af;">&copy; {{ date('Y') }} {{ config('app.name','Funori') }}. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>


