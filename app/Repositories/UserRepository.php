<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{

    public function createUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
    public function getUserByEmail(Request $request)
    {
        $user = User::select('id','name','email','role_id','status','is_delete')
        ->with(['role' => function($q){
            $q->select('id' , 'role_name');
        }])
        ->where('email', $request->email)
        ->first();

        unset($user->role_id);
        return $user;
    }

}
