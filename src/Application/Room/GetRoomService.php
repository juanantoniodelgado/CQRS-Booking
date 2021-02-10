<?php

declare(strict_types=1);

namespace App\Application\Room;

use App\Domain\Model\Room\Room;
use App\Domain\Model\Room\RoomRepositoryInterface;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\InvalidParameterException;
use App\Infrastructure\Exception\WritingException;

class GetRoomService
{
    private AddRoomService $addRoomService;
    private RoomRepositoryInterface $repository;

    public function __construct(AddRoomService $addRoomService, RoomRepositoryInterface $repository)
    {
        $this->addRoomService = $addRoomService;
        $this->repository = $repository;
    }

    /**
     * @param int $roomId
     * @param string $name
     *
     * @return Room
     *
     * @throws InvalidParameterException
     * @throws WritingException
     */
    public function execute(int $roomId, string $name): Room
    {
        try {
            $room = $this->repository->byId($roomId);
        } catch (EntityNotFoundException) {
            $room = $this->addRoomService->execute($roomId, $name);
        }

        return $room;
    }
}