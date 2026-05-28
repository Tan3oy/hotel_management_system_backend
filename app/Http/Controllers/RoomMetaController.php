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
public function updateRoomType($request)
{
        return $this->roomMetaService->updateRoomType($request);
}
public function toggleRoomTypeStatus($request)
{
        return $this->roomMetaService->toggleRoomTypeStatus($request);
}
public function deleteRoomType($request)
{
        return $this->roomMetaService->deleteRoomType($request);
}
public function     public function createBedType($request)
($request)
{
        return $this->roomMetaService->    public function createBedType($request)
($request);
}

}