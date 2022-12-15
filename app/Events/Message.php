<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }


    public function broadcastWith()
    {
        return [
            "id"=>$this->message->id,
            "chat_id"=>$this->message->chat_id,
            "user_id"=>$this->message->user_id,
            "text"=>$this->message->text
        ];
    }

    public function broadcastAs()
    {
        return 'message.new';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chatio'.$this->message->chat_id);
    }
}