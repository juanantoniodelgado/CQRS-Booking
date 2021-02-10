<?php

declare(strict_types=1);

namespace App\Application\Room;

use App\Domain\Model\Room\Room;
use App\Domain\Model\Room\RoomRepositoryInterface;
use App\Infrastructure\Exception\InvalidParameterException;

class AddRoomService
{
    private RoomRepositoryInterface $repository;

    public function __construct(RoomRepositoryInterface $repository)
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
    public function execute(int $roomId, string $name): Room
    {
        $room = new Room($roomId, $name);

        $this->repository->save($room);

        return $room;
    }
}