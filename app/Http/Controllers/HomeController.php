<?php

namespace App\Http\Controllers;

use App\Services\RemoteUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function home(Request $request){

        $requestUrl = RemoteUrl::get('user/validate');

        $response = Http::asForm()->post($requestUrl, [
            'uuid'  =>  $request->get('uuid')
        ]);

        if(!key_exists('name', $response->json()) && !key_exists('email', $response->json()) && !key_exists('bearer_token', $response->json())) {
            return redirect()->route('getLogin');
        }

        session()->put('name', $response->json()['name']);
        session()->put('email', $response->json()['email']);
        session()->put('bearer_token', $response->json()['bearer_token']);

        return redirect()->route('profileOverview');
    }

}
