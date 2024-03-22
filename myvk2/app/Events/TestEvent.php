<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    private $message;

    public function __construct($message)
    {
	$this->message = $message;
    }
    public function broadcastOn(): array
    {
        return [
            new Channel("store_message"),
        ];
    }
    public function broadcastAs(): string
    {
        return "store.m";
    }
    public function broadcastWith(): array
    {
        return ["message" => 1111222];
    }

}
