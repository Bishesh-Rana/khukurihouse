<?php

namespace App\Listeners;

use App\Mail\DeliveryAssignMail;
use Illuminate\Support\Facades\Mail;
use App\Events\DeliveryAssignMailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeliveryAssignMailListener
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
     * @param  DeliveryAssignMailEvent  $event
     * @return void
     */
    public function handle(DeliveryAssignMailEvent $event)
    {
        Mail::to($event->delivery_email)->send(new DeliveryAssignMail($event->ref_id));
        
    }
}
