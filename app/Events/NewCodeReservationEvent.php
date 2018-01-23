<?php

namespace App\Events;

use App\Rental;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewCodeReservationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Rental
     */
    public $rental;
    public $code;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Rental $rental, $code)
    {
        $this->rental = $rental;
        $this->code = $code;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
