<?php

namespace App\Services;

use App\Helpers\CommonUtils;
use App\Models\BedType;
use App\Models\RoomType;
use App\Repositories\Interfaces\RoomMetaInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoomMetaService
{
    use CommonUtils;
    protected $repoRoom;

    public function __construct(
        RoomMetaInterface $repoRoom
    ) {
        $this->repoRoom = $repoRoom;
    }
    public function createRoomType($request)
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
    public function updateRoomType($request)
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
    public function toggleRoomTypeStatus($request)
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
    public function deleteRoomType($request)
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
    public function createBedType($request)
    {
        $rules = [
            'name' => 'required|string|unique:bed_types,name',
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
    public function updateBedType($request)
    {
        $rules = [
            'bed_type_id' => 'required|integer|exists:bed_types,id',
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
    public function toggleBedTypeStatus($request)
    {
        $rules = [
            'bed_type_id' => 'required|integer|exists:bed_types,id',
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
    public function deleteBedType($request)
    {
        $rules = [
            'bed_type_id' => 'required|integer|exists:bed_types,id',
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
