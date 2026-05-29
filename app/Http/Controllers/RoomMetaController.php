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

        public function createRoomType(Request $request)
        {
                return $this->roomMetaService->createRoomType($request);
        }
        public function updateRoomType(Request $request)
        {
                return $this->roomMetaService->updateRoomType($request);
        }
        public function toggleRoomTypeStatus(Request $request)
        {
                return $this->roomMetaService->toggleRoomTypeStatus($request);
        }
        public function deleteRoomType(Request $request)
        {
                return $this->roomMetaService->deleteRoomType($request);
        }
        public function createBedType(Request $request)
        {
                return $this->roomMetaService->createBedType($request);
        }

}