<?php

namespace App\Services;

use App\Helpers\CommonUtils;
use App\Models\BedType;
use App\Models\RoomType;
use App\Repositories\Interfaces\RoomMetaInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoomMetaService
{
    use CommonUtils;

    public function __construct(

    ) {
    }
    public function createRoomType(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:room_types,name',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $roomTypeModel = new RoomType();

        $roomTypeModel->name = $request->name;
        $roomTypeModel->save();
        return $this->returnSuccess(201, 'New Room Type added successfully');

    }
    public function listRoomType(Request $request)
    {
        $roomTypeList = RoomType::select('id','name')->orderBy('id','desc')->get();

        return $this->returnSuccess(201, $roomTypeList);
    }
    public function roomTypeDropdown(Request $request)
    {
        $roomTypeList = RoomType::select('id as value','name as label')->orderBy('name','asc')->get();

        return $this->returnSuccess(201, $roomTypeList);
    }
    public function RoomTypeDetails(Request $request)
    {
        $rules = [
            'room_type_id' => 'required|integer|exists:room_types,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $roomTypeList = RoomType::select('id as value','name as label')->orderBy('name','asc')->get();

        return $this->returnSuccess(201, $roomTypeList);
    }
    public function updateRoomType(Request $request)
    {
        $rules = [
            'room_type_id' => 'required|integer|exists:room_types,id',
            'name' => ['required', 'string', Rule::unique('room_types', 'name')->ignore($request->room_type_id)],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $roomTypeModel = RoomType::find($request->room_type_id);

        $roomTypeModel->name = $request->name;
        $roomTypeModel->save();

        return $this->returnSuccess(201, 'Room Type updated successfully');

    }
    public function toggleRoomTypeStatus(Request $request)
    {
        $rules = [
            'room_type_id' => 'required|integer|exists:room_types,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $roomTypeModel = RoomType::find($request->room_type_id);

        $roomTypeModel->status = !$roomTypeModel->status;
        $roomTypeModel->save();

        return $this->returnSuccess(201, 'Room Type status updated successfully');
    }
    public function deleteRoomType(Request $request)
    {
        $rules = [
            'room_type_id' => 'required|integer|exists:room_types,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $roomTypeModel = RoomType::find($request->room_type_id);

        $roomTypeModel->is_delete = 1;
        $roomTypeModel->save();

        return $this->returnSuccess(201, 'Room Type deleted successfully');
    }
    public function createBedType(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:room_bed_types_master,name',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $bedTypeModel = new BedType();

        $bedTypeModel->name = $request->name;
        $bedTypeModel->save();
        return $this->returnSuccess(201, 'New Bed Type added successfully');

    }
    public function updateBedType(Request $request)
    {
        $rules = [
            'bed_type_id' => 'required|integer|exists:room_bed_types_master,id',
            'name' => ['required', 'string', Rule::unique('bed_types', 'name')->ignore($request->bed_type_id)],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $bedTypeModel = BedType::find($request->bed_type_id);

        $bedTypeModel->name = $request->name;
        $bedTypeModel->save();

        return $this->returnSuccess(201, 'Bed Type updated successfully');

    }
    public function toggleBedTypeStatus(Request $request)
    {
        $rules = [
            'bed_type_id' => 'required|integer|exists:room_bed_types_master,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $bedTypeModel = BedType::find($request->bed_type_id);

        $bedTypeModel->status = !$bedTypeModel->status;
        $bedTypeModel->save();

        return $this->returnSuccess(201, 'Bed Type status updated successfully');
    }
    public function deleteBedType(Request $request)
    {
        $rules = [
            'bed_type_id' => 'required|integer|exists:room_bed_types_master,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $bedTypeModel = BedType::find($request->bed_type_id);

        $bedTypeModel->is_delete = 1;
        $bedTypeModel->save();

        return $this->returnSuccess(201, 'Bed Type deleted successfully');
    }

}
