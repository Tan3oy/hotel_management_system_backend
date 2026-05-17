<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api',['except' => ['register','login']]);
        $this->userService = $userService;
    }
    public function register(Request $request)
    {
        $this->userService->register($request);
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6',
        // ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // return response()->json([
        //     'message' => 'User registered successfully'
        // ]);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }
}
