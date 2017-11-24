<?php

namespace Gtapps\Aftership;

use AfterShip\Couriers;
use AfterShip\LastCheckPoint;
use AfterShip\Notifications;
use AfterShip\Tracking;
use Illuminate\Support\Facades\Config;

class Aftership {

    public function couriers() {
        return new Couriers(Config::get('aftership-laravel::api_key'));
    }

    public function tracking() {
        return new Tracking(Config::get('aftership-laravel::api_key'));
    }

    public function lastCheckPoint() {
        return new LastCheckPoint(Config::get('aftership-laravel::api_key'));
    }

    public function notifications() {
        return new Notifications(Config::get('aftership-laravel::api_key'));
    }

}
