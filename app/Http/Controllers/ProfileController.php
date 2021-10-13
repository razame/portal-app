<?php

namespace App\Http\Controllers;

use App\Services\RemoteUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function profileOverview(Request $request){
        return view('profile.profile-overview');
    }

    public function emailSettings(Request $request){
        return view('profile.email-settings');
    }

    public function changeEmail(Request $request){

        $rules = [
            'old_email'     =>  'email|required',
            'email'         =>  'email|required'
        ];

        $request->validate(
            $rules,
            [
                'email.required' => 'New Email is required',
                'email.email' => 'New Email format is incorrect'
            ]
        );

        $requestUrl = RemoteUrl::get('change-email');

        $response = Http::withToken(session()->get('bearer_token'))->post($requestUrl, $request->only(array_keys($rules)));

        if($response->body() === 'Unauthorized.')
            return response()->json('Unauthorized.', 404);

        if(is_null($response->json()) || !key_exists('email', $response->json()))
            return response()->json(json_decode($response->body()), 500);

        return response()->json($response->json()['email']);
    }
}
