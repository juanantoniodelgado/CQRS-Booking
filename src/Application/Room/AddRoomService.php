<?php

declare(strict_types=1);

namespace App\Application\Room;

use App\Domain\Model\Room\Room;
use App\Domain\Model\Room\RoomRepository;
use App\Infrastructure\Exception\InvalidParameterException;

class AddRoomService
{
    private RoomRepository $repository;

    public function __construct(RoomRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $roomId
     * @param string $name
     *
     * @return Room
     *
     * @throws InvalidParameterException
     */
    public function create(int $roomId, string $name): Room
    {
        $room = new Room($roomId, $name);
        $this->repository->save($room);

        return $room;
    }
}