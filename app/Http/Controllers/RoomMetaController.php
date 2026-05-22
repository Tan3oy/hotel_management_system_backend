<?php

namespace App\Http\Controllers;
use App\Services\RoomMetaService;
use Illuminate\Http\Request;

class RoomMetaController extends Controller
{
    protected RoomMetaService $roomMetaService;
    public function __construct(RoomMetaService $roomMetaService)
    {
        $this->middleware('auth:api', ['except' => []]);
        $this->roomMetaService = $roomMetaService;
    }

 public function createRoomType($request)
{
        return $this->roomMetaService->createRoomType($request);
}
}