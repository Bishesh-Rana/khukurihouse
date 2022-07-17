<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AffiliateRegisterConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $affiliate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($affiliate)
    {
        $this->affiliate = $affiliate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(config('app.name').' Affiliate Verification')->markdown('emails.affiliate.affiliateregisterconfirmation');
    }
}
