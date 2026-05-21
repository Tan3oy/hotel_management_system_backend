<?php

namespace App\Http\Controllers;
use App\Services\RoomService;
use App\Services\UserService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected RoomService $roomService;
    public function __construct(RoomService $roomService)
    {
        $this->middleware('auth:api', ['except' => []]);
        $this->roomService = $roomService;
    }

 public function createRoom($request)
{
        return $this->roomService->createRoom($request);
}
}