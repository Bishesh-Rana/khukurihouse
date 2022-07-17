<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApiCustomerForgetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $forgot_password_otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($forgot_password_otp)
    {
        $this->forgot_password_otp = $forgot_password_otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user.apicustomerforgetpassword');
    }
}
