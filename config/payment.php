<?php

return [
    'vnpay' => [
        'tmn_code' => env('VNPAY_TMN_CODE', 'I7RJJOXP'),
        'hash_secret' => env('VNPAY_HASH_SECRET', 'XWLM4D1JIH7YPSP3UC2V1261SUG95CI2'),
        'url' => env('VNPAY_URL', 'https://pay.vnpay.vn/vpcpay.html'),
        'refund_url' => env('VNPAY_REFUND_URL', 'https://pay.vnpay.vn/merchant_webapi/api/transaction'), // ✅ Production URL
        'return_url' => env('VNPAY_RETURN_URL', 'http://localhost:8000/vnpay/return'),
        'ipn_url' => env('VNPAY_IPN_URL', 'http://localhost:8000/vnpay/ipn'),
    ],
    'momo' => [
        'partner_code' => env('MOMO_PARTNER_CODE'),
        'access_key' => env('MOMO_ACCESS_KEY'),
        'secret_key' => env('MOMO_SECRET_KEY'),
        'url' => env('MOMO_URL', 'https://test-payment.momo.vn/v2/gateway/api/create'),
        'refund_url' => env('MOMO_REFUND_URL', 'https://test-payment.momo.vn/v2/gateway/api/refund'),
        'return_url' => env('MOMO_RETURN_URL', 'http://localhost:8000/momo/return'),
    ],
];
