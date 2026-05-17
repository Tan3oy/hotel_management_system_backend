<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
        $this->userService = $userService;
    }
    public function register(Request $request)
    {
        return $this->userService->register($request);
    }
    public function login(Request $request)
    {
        return $this->userService->login($request);

    }
}
