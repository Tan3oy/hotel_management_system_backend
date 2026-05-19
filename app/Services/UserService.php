<?php

namespace App\Services;

use App\Helpers\CommonUtils;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserService
{
    use CommonUtils;
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
            'password' => 'required|min:6|max:25|confirmed',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $this->userRepository->createUser($request);
        return $this->returnSuccess(201, 'User Registered Successfully');
    }
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|min:6|max:25',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($credentials)) {
            $user = $this->userRepository->getUserByEmail($request);
            if ($user->is_delete == 1) {

                return $this->returnFail(1, ["User not found"]);
            }

            if ($user->status == 0) {
                return $this->returnFail(1, ["Your Account has been deactivated"]);
                }
                if ($user->role_id != 1) {
                $this->log($user);
                return $this->returnFail(1, ["You don't have access"]);
            }
            $token = Auth::user()->createToken('authToken')->accessToken;
            return $this->returnSuccess(200, [
                'user' => $user,
                'token' => $token
            ]);
        }
        return $this->returnFail(1, ["Invalid Credentials"]);

    }
}
