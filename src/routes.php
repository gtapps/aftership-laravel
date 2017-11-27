<?php

use \Illuminate\Support\Facades\Config,
    \Illuminate\Support\Facades\Route,
    \Illuminate\Support\Facades\Input,
    \Illuminate\Support\Facades\Event,
    \Illuminate\Support\Facades\Queue;
    Gtapps\AfterShipLaravel\Events\AfterShipTrackingUpdated;

$weebhookEnabled = Config::get('aftership-laravel::web_hook.enabled');
if ($weebhookEnabled == true) {
    $routeUrl = Config::get('aftership-laravel::web_hook.route_url');
    if (!empty($routeUrl)) {
        Route::post($routeUrl, function () {
            $listenerType = Config::get('aftership-laravel::web_hook.listener.type');
            $handler = Config::get('aftership-laravel::web_hook.listener.handler');
            if (empty($listenerType) || empty($handler))
                throw new Exception('Listener Configuration is incomplete.');

            if ($listenerType == "event") {
                event(new AfterShipTrackingUpdated(request()->input('event'), request()->input('msg')));
            } elseif ($listenerType == "queue") {
                $queueConnection = Config::get('aftership-laravel::web_hook.listener.queue_connection');
                $queueName = Config::get('aftership-laravel::web_hook.listener.queue_name');

                if (empty($queueConnection)) {
                    if (empty($queueName)) {
                        Queue::push($handler, array('data' => Input::all()));
                    } else {
                        Queue::push($handler, array('data' => Input::all()), $queueName);
                    }
                } else {
                    if (empty($queueName)) {
                        Queue::connection($queueConnection)->push($handler, array('data' => Input::all()));
                    } else {
                        Queue::connection($queueConnection)->push($handler, array('data' => Input::all()), $queueName);
                    }
                }
            }
        });
    } else {
        throw new Exception('Route URL cannot be empty when Webhook is enabled.');
    }
}
