<?php

declare(strict_types=1);

namespace App\Application\Room;

use App\Domain\Model\Room\Room;
use App\Domain\Model\Room\RoomRepository;

class AddRoomService
{
    private RoomRepository $repository;

    public function __construct(RoomRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(int $roomId, string $name): Room
    {
        $room = new Room($roomId, $name);
        $this->repository->save($room);

        return $room;
    }
}