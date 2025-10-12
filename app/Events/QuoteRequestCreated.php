<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use League\CommonMark\Extension\SmartPunct\Quote;

class QuoteRequestCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $quote;
    /**
     * Create a new event instance.
     */
    public function __construct($quote)
    {
        $this->quote = $quote;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('quote-requests'),
        ];
    }
}
