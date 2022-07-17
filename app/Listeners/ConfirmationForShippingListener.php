<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\ConfirmationForShipping;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ConfirmationForShippingMail;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationForShippingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ConfirmationForShipping  $event
     * @return void
     */
    public function handle(ConfirmationForShipping $event)
    {
        Mail::to($event->seller_email)->send(new ConfirmationForShippingMail($event->ref_id));
    }
}
