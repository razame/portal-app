<?php

namespace App\Http\Controllers;

use App\Services\RemoteUrl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Postmark\PostmarkClient;

class LoginController extends Controller
{

    public function showLoginPage () {
        return view('login');
    }

    public function login (Request $request) {

        $request->validate([
            'email'     =>  'email|required'
        ]);

        $requestUrl = RemoteUrl::get('login');

        $response = Http::asForm()->post($requestUrl, [
            'email'             =>  $request->get('email')
        ]);

        if($response->getStatusCode() !== 200)
            return redirect()->back()->with('errors', collect($response->json()))->withInput();

        $url = URL::temporarySignedRoute(
            'home', Carbon::now()->addMinutes(config('services.temporary_signed_url_timeout')), ['uuid' => $response->json()['uuid']]
        );

        $client = new PostmarkClient(config('services.postmark.token'));

        $client->sendEmail(
            config('services.postmark.from_email'),
            $request->get('email'),
            "Hello from Postmark!",
            "Hello ".$response->json()['name']."! This is the link for sign-in <br><br><br>".$url.'<br><br><br>Please note that this link will expire in '.config('services.temporary_signed_url_timeout').' minutes'
        );

        return redirect()->route('getLogin')->with('message', 'Link sent successfully!');

    }

}
