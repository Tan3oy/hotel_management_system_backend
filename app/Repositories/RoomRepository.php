<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomInterface;
use Illuminate\Support\Facades\Auth;

class RoomRepository implements RoomInterface
{
 public function createRoom($request)
 {
    $user = Auth::user();
    $room = new Room();
    $room->name = $request->name;
    $room->room_type_id = $request->room_type_id;
    $room->bed_type_id = $request->bed_type_id;
    $room->size = $request->size;
    $room->view_type_id = $request->view_type_id;
    $room->rating = $request->rating;
    $room->created_by = $user->id;
    
    $room->save();
 }
}
