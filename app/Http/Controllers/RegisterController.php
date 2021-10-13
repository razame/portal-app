<?php

namespace App\Http\Controllers;

use \App\Services\GuzzleService;
use App\Services\RemoteUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{

    public function showRegisterPage () {
        return view('register');
    }

    public function register (Request $request) {

        $request->validate([
            'email'     =>  'email|required',
            'name'      =>  'string|required'
        ]);

        $requestUrl = RemoteUrl::get('register');

        $response = Http::asForm()->post($requestUrl, [
            'name'              =>  $request->get('name'),
            'email'             =>  $request->get('email')
        ]);

        if($response->getStatusCode() !== 201)
            return redirect()->back()->with('errors', collect($response->json()))->withInput();

        return redirect()->back()->with('message', 'Registered Successfully!');

    }

}
