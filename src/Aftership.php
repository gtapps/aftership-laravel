<?php

namespace Gtapps\AfterShipLaravel;

use AfterShip\Couriers;
use AfterShip\LastCheckPoint;
use AfterShip\Notifications;
use AfterShip\Trackings;
use Illuminate\Support\Facades\Config;

class Aftership {

    public function couriers() {
        return new Couriers(config('aftership-laravel.api_key'));
    }

    public function trackings() {
        return new Trackings(config('aftership-laravel.api_key'));
    }

    public function lastCheckPoint() {
        return new LastCheckPoint(config('aftership-laravel.api_key'));
    }

    public function notifications() {
        return new Notifications(config('aftership-laravel.api_key'));
    }

}
