<?php

namespace App\Services;

use App\Helpers\CommonUtils;
use App\Repositories\Interfaces\RoomInterface;
use Illuminate\Support\Facades\Validator;

class RoomService
{
    use CommonUtils;
    protected $repoRoom;

    public function __construct(
        RoomInterface $repoRoom
    ) {
        $this->repoRoom = $repoRoom;
    }
 public function createRoom($request)
{
    $rules = [
        'name' => 'required|string',
        'room_type_id' => 'required|integer|exists:room_types_master,id',
        'bed_type_id' => 'required|integer|exists:bed_types_master,id',
        'size' => 'required|integer',
        'view_type_id' => 'required|integer|exists:view_types_master,id',
        'rating' => 'required|numeric|min:0|max:5',
    ];
    $validator = Validator::make($request->all(),$rules);
    if($validator->fails()){
        return $this->returnFail(1,$validator->errors()->all());
    }
    $this->repoRoom->createRoom($request);
    $this->returnSuccess(201,'Room created successfully');
}

}
