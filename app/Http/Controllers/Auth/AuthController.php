<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        
        $email = $request->email;
        $password = $request->password;

        $token = Auth::attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            return response()->json([], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'accessToken' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function myUser()
    {
        return response()->json(Auth::user(), Response::HTTP_OK);
    }

}
