<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleAuthController extends Controller
{
    public function index(Request $request)
    {
        $end = 'https://www.googleapis.com/oauth2/v3/userinfo';

        if ($request->has('access_token')) {
            $http = Http::withToken($request->access_token)
                ->withHeaders([
                    'Accept' => 'application/json'
                ])
                ->get($end);

            $result = $http->json();

            $user = User::where('email', $result['email'])->sole();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => true], 402);
        }
    }
}
