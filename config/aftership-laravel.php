<?php
use Gtapps\AfterShipLaravel\Events\AfterShipTrackingUpdated;

return [
    'api_key'  => '',
    'web_hook' => [
        'enabled'   => false,
        'route_url' => '/webbooks/aftership',
        'listener'  => [
            'type'             => 'event',
            'handler'          => AfterShipTrackingUpdated::class,
            'queue_name'       => '', //Used only if the type == "queue"
            'queue_connection' => '' //To be used if a connection based queue needs to be used
        ]
    ]
];
