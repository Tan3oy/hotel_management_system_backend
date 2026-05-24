<?php

namespace App\Services;

use App\Helpers\CommonUtils;
use App\Models\RoomType;
use App\Repositories\Interfaces\MetaInterface;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetaService
{
    use CommonUtils;
    // protected $repoRoom;

    // public function __construct(
    //     MetaInterface $repoRoom
    // ) {
    //     $this->repoRoom = $repoRoom;
    // }
    public function createRoomType(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:room_types_master,name',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnFail(1, $validator->errors()->all());
        }
        $user = Auth::user() ;
        RoomType::create([
            'name' => $request->name,
            'created_by' => $user->id
        ]);
        return $this->returnSuccess(201, 'Room Type created successfully');
    }

}
