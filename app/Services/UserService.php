<?php

namespace App\Services;

use App\Repositories\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserService
{
    protected $userRepository;

    public function __construct(
        UserInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
        $validator = Validator::make($request->all(), $rules);
    }
}
