<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DeliveryAssignMailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $delivery_email, $ref_id;

    public function __construct($delivery_email ,$ref_id)
    {
        $this->delivery_email = $delivery_email;
        $this->ref_id = $ref_id;
    }

}
