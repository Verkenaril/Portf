<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Chat;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $message;
    private $user_recipient;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $r)
    {
	$this->message = $message;
	$this->user_recipient = $r;
    }
    public function broadcastOn(): array
    {
        $a = Chat::find($this->message->chat_id)->user_smaller_id;
        $b = Chat::find($this->message->chat_id)->user_bigger_id;
        return [
            new Channel("store_message". $a . $b),
            new Channel("user_recipient" . $this->user_recipient)
        ];
    }
    public function broadcastAs(): string
    {
        return "store.m";
    }
    public function broadcastWith(): array
    {
        return ["message" => $this->message,
        ];
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

}
