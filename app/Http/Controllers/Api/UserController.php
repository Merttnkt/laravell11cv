<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' =>'required| string',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' =>'Success'] , 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' =>'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([$request->only('email', 'password')])){
            $user = user::where('email',$request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token] ,200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
