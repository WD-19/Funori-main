<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Shipper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public Shipper $shipper;

    public function __construct(Order $order, Shipper $shipper)
    {
        $this->order = $order;
        $this->shipper = $shipper;
    }

    public function build()
    {
        return $this->subject('Bạn có đơn hàng mới #' . $this->order->order_code)
            ->view('emails.shipper.new-order-assigned')
            ->with([
                'order' => $this->order,
                'shipper' => $this->shipper,
            ]);
    }
}


