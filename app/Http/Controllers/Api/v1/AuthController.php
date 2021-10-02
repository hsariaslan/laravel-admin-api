<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (LoginRequest $request):Response
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return response([
                'message' => 'Login successful',
            ], 200);
        }

        return response([
            'message' => 'The provided credentials do not match our records',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response([
            'message' => 'Logged out'
        ], 200);
    }
}
