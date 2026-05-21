<?php

namespace App\Services;

use App\Repositories\Interfaces\RoomInterface;

class RoomService
{
    protected $roomRepository;

    public function __construct(
        RoomInterface $roomRepository
    ) {
        $this->roomRepository = $roomRepository;
    }
}
