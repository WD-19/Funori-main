<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Shipper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShipperResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public ?Shipper $shipper;
    public string $response;
    public ?string $reason;

    public function __construct(Order $order, ?Shipper $shipper, string $response, ?string $reason = null)
    {
        $this->order = $order;
        $this->shipper = $shipper;
        $this->response = $response;
        $this->reason = $reason;
    }

    public function build()
    {
        $subject = $this->response === 'accepted'
            ? 'Shipper đã nhận đơn #' . $this->order->order_code
            : 'Shipper đã từ chối đơn #' . $this->order->order_code;

        return $this->subject($subject)
            ->view('emails.admin.shipper-response')
            ->with([
                'order' => $this->order,
                'shipper' => $this->shipper,
                'response' => $this->response,
                'reason' => $this->reason,
            ]);
    }
}


