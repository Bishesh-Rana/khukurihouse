<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ConfirmationForShipping
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $seller_email,$ref_id;

    public function __construct($seller_email,$ref_id)
    {
        $this->seller_email = $seller_email;
        $this->ref_id = $ref_id;
    }
}
