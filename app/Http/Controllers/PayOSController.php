<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PayOSController
{
    public function createPayment()
    {
        $orderCode = rand(100000, 999999);
        $amount = 100000;
        $description = "Test";
        $cancelUrl = route('payos.cancel');
        $returnUrl = route('payos.return');

        $data = [
            'amount' => $amount,
            'cancelUrl' => $cancelUrl,
            'description' => $description,
            'orderCode' => $orderCode,
            'returnUrl' => $returnUrl,
        ];

        // Tạo signature
        $rawData = "amount=$amount&cancelUrl=$cancelUrl&description=$description&orderCode=$orderCode&returnUrl=$returnUrl";
        $signature = hash_hmac('sha256', $rawData, env('PAYOS_CHECKSUM_KEY'));


        // Gộp thêm signature
        $data['signature'] = $signature;

        $response = Http::withHeaders([
            'x-client-id' => env('PAYOS_CLIENT_ID'),
            'x-api-key' => env('PAYOS_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api-merchant.payos.vn/v2/payment-requests', $data);

        if (!$response->successful()) {
            Log::error('PayOS Error', ['status' => $response->status(), 'body' => $response->body()]);
            dd($response->status(), $response->body());
        }

        return redirect($response['data']['checkoutUrl']);
    }


    public function return(Request $request)
    {
        // Xử lý khi người dùng thanh toán xong
        return "Thanh toán thành công!";
    }

    public function cancel()
    {
        // Xử lý khi người dùng hủy thanh toán
        return "Bạn đã hủy thanh toán.";
    }
}
