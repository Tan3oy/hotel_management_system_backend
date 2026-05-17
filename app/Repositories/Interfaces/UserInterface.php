<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface UserInterface
{
    public function createUser(Request $request);
    public function getUserByEmail(Request $request);
}
