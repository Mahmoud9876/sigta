<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class TransportEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $sntl, $old, $selection;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sntl, $old, $selection)
    {
        $this->sntl       = $sntl;
        $this->old        = $old;
        $this->selection  = $selection;
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