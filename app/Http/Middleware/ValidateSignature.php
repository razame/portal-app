<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Middleware\ValidateSignature as BaseMiddleware;

class ValidateSignature extends BaseMiddleware
{

    public function handle($request, Closure $next, $relative = null)
    {
        if ($request->hasValidSignature($relative !== 'relative')) {
            return $next($request);
        }

        return Redirect::guest(URL::route( 'getLogin'));
    }

}
