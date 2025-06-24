<?php

namespace App\Http\Controllers;

use App\Models\User;
use Google\Client;
use Google\Service\Oauth2;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login',);
    }

    public function loginUser(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::query()->where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
            ], 401);
        }
        $user->tokens()->delete();
        $token = $user->createToken('authToken');
        return response()->json(['success' => true])
            ->withCookie('auth_token', $token->plainTextToken, 2880, null, null, false, false);
    }

    public function authenticate(): JsonResponse
    {
        return response()->json(['user' => Auth::user()?->only(['id', 'name', 'email'])]);
    }

    public function logout(Request $request): JsonResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->tokens->each(function ($token) {
                $token->delete();
            });
            $request->cookies->remove('auth_token');
        }
        return response()->json(["logout" => true]);
    }

    public function googleLogin(Request $request): JsonResponse
    {
        $code = $request->get('code');
        logger($code);
        if (!$code) {
            abort(404);
        }

        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $accessToken = $client->fetchAccessTokenWithAuthCode($code)['access_token'];
        $client->setAccessToken($accessToken);
        $service = new Oauth2($client);
        $userInfo = $service->userinfo->get();
        $data = [
            'email' => $userInfo->getEmail(),
            'name' => $userInfo->getName(),
        ];
        $user = User::query()->where('email', $data['email'])->first();

        if (!$user) {
            $user = User::query()->create([
                'email' => $data['email'],
                'name' => $data['name'],
                'password' => Hash::make(Str::password()),
            ]);
        }
        $user->tokens()->delete();
        $token = $user->createToken('authToken');
        return response()->json(['success' => true])
            ->withCookie('auth_token', $token->plainTextToken, 2880, null, null, false, false);
    }
}
