<?php

namespace App\Http\Middleware;


use App\Services\RemoteUrl;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CheckApiAuthentication {

    public function handle($request, \Closure $next, $redirectToRoute = null){

        $requestUrl = RemoteUrl::get('user-details');

        $response = Http::withToken(session()->get('bearer_token'))->get($requestUrl);

        if ($response->body() === 'Unauthorized.') {
            return Redirect::guest(URL::route($redirectToRoute ?: 'getLogin'));
        }

        session()->put('name',  $response->json()['name']);
        session()->put('email', $response->json()['email']);
        return $next($request);
    }
}
