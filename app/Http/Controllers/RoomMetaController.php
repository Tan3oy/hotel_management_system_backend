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
        public function viewRoomType(Request $request)
        {
                return $this->roomMetaService->RoomTypeDetails($request);
        }
        public function listRoomType(Request $request)
        {
                return $this->roomMetaService->listRoomType($request);
        }
        public function roomTypeDropdown(Request $request)
        {
                return $this->roomMetaService->roomTypeDropdown($request);
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
         public function bedTypeDropdown(Request $request)
        {
                return $this->roomMetaService->bedTypeDropdown($request);
        }

        public function viewBedType(Request $request)
        {
                return $this->roomMetaService->BedTypeDetails($request);
        }
        public function listBedType(Request $request)
        {
                return $this->roomMetaService->listBedType($request);
        }
        public function updateBedType(Request $request)
        {
                return $this->roomMetaService->updateBedType($request);
        }
        public function toggleBedTypeStatus(Request $request)
        {
                return $this->roomMetaService->toggleBedTypeStatus($request);
        }
        public function deleteBedType(Request $request)
        {
                return $this->roomMetaService->deleteBedType($request);
        }

}