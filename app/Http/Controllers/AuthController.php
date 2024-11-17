<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function signIn(LoginRequest $request)
    {
        $auth = (auth()->attempt(['email' => $request->email, 'password' => $request->password]));

        if ($auth != false) {
            return response()->json([
                'status' => 'success',
                'message' => 'Login successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Login failed'
            ], 403);
        }
    }

    public function logout(Request $request)
    {
        return redirect()->route('login');
    }
}
