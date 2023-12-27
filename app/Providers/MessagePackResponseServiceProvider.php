<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Pluto;

class MessagePackResponseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('msgpackRes', function ($value) {
            $value = Pluto::pack($value);
            $res = response($value)->header(
                'Content-Type',
                'application/x-msgpack'
            );
            return $res;
        });
    }
}
