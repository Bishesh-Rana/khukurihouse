<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SellerCheckoutMail extends Mailable
{
    use Queueable, SerializesModels;
    public $payment, $orders;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment, $orders)
    {
        $this->orders = $orders;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Order')->markdown('emails.seller.sellercheckoutmail');
    }
}
