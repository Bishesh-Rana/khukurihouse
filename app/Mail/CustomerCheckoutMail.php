<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerCheckoutMail extends Mailable
{
    use Queueable, SerializesModels;
    public $payment, $orders, $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment, $orders,$pdf)
    {
        $this->payment = $payment;
        $this->orders = $orders;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Details')
                    ->markdown('emails.customer.customercheckoutmail')
                    ->attachData($this->pdf->output(), "Booking Invoice.pdf");
    }
}
