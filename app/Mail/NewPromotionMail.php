<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Promotion;


class NewPromotionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $promotion;

    public function __construct(Promotion $promotion)
    {
        $this->promotion = $promotion;
    }

    public function build()
    {
        return $this->subject('Có mã giảm giá mới từ Funori!')
            ->view('emails.new_promotion');
    }
}
