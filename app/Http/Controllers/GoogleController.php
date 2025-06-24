<?php

namespace App\Http\Controllers;

use Google\Client;
use Illuminate\Http\Request;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $googleClient = new Client();
        $googleClient->setRedirectUri(config('services.google.redirect'));
        $googleClient->setClientId(config('services.google.client_id'));
        $googleClient->setPrompt('consent select_account');
        $googleClient->setScopes(['openid', 'profile', 'email']);

        $redirectUrl = $googleClient->createAuthUrl();

        return redirect()->away($redirectUrl);
    }

    public function handleGoogleCallback(Request $request)
    {

        if (!$request->has('code')) {
            return "<script>window.close()</script>";
        }
        $code = $request->get('code');
        return response()->view('auth.google-auth', compact('code'));

    }
}

