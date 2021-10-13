<?php

namespace App\Services;

class RemoteUrl {

    public static function get($path) : string {
        return config('services.api_url').$path;
    }

}
