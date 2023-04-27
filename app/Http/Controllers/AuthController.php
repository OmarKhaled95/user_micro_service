<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email', 'is_admin')
                + [
                    'password' => Hash::make($request->input('password')),
                ]
        );
        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        if (!\Auth::attempt($request->only('email', 'password'))) {
            return response([
                'error' => 'invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = \Auth::user();
        $token = $user->createToken('token', [$request->input('scope')])->plainTextToken;
        return compact('token');
    }

    public function show_user(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {



        $user = $request->user();
        $user->tokens()->delete();

        return 'success';
    }
}
