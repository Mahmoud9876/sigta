<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class AssujettiEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $message, $event, $type, $centre, $operation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $event, $type, $operation, $centre = null)
    {
        $this->message    = $message;
        $this->event      = $event;
        $this->type       = $type;
        $this->centre     = $centre;
        $this->operation  = $operation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('events');
    }
}