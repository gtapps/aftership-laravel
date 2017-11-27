<?php

namespace  Gtapps\AfterShipLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Extensions\Softna\Ecommerce\Models\Order;

class AfterShipTrackingUpdated{
    use SerializesModels;

    public $eventId, $data, $trackingMessage, $checkpoint;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct() {
        $this->eventId = request()->input('event');
        $this->data = request()->input('msg');
        if(!empty($this->data['checkpoints'])){
            $this->checkpoint = array_pop($this->data['checkpoints']);
            $this->trackingMessage = $this->checkpoint['city'].' - '.$this->checkpoint['message'];
        }
        
    }
    
}