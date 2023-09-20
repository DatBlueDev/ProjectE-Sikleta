<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username1;
    public $username2;
    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct($username1,$username2, $message)
    {
        $this->username1 = $username1;
        $this->username2 = $username2;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        $channelName = 'private-chat.' . $this->username1 . '.' . $this->username2;
        return new PrivateChannel($channelName);
    }
    public function broadcastAs(){
        return 'sendmessage';
    }
}
