<?php

namespace  Gtapps\AfterShipLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Extensions\Softna\Ecommerce\Models\Order;

class AftershipTrackingUpdated{
    use SerializesModels;

    public $eventId, $data, $trackingMessage, $order, $checkpoint;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($eventId, array $data) {
        $this->eventId = $eventId;
        $this->data =  $data;
        $this->order = Order::find($this->data['order_id']);
        if(!empty($this->data['checkpoints'])){
            $this->checkpoint = array_pop($this->data['checkpoints']);
            $this->trackingMessage = $this->checkpoint['city'].' - '.$this->checkpoint['message'];
        }
        
    }
    
}