<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FormationEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $message, $event, $type, $formation, $old_formation, $id, $old_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $event, $type, $id, $old_id, $formation, $old_formation)
    {
        $this->message        = $message;
        $this->event          = $event;
        $this->type           = $type;
        $this->id             = $id;
        $this->old_id         = $old_id;
        $this->formation      = $formation;
        $this->old_formation  = $old_formation;
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