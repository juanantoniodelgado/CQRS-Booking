<?php

declare(strict_types=1);

namespace App\Application\Room;

use App\Domain\Model\Room\Room;
use App\Domain\Model\Room\RoomRepository;
use App\Infrastructure\Exception\EntityNotFoundException;

class CheckOrAddRoomService
{
    private RoomRepository $repository;
    private AddRoomService $createRoomService;

    public function __construct(RoomRepository $repository, AddRoomService $createRoomService)
    {
        $this->repository = $repository;
        $this->createRoomService = $createRoomService;
    }

    public function check(int $roomId, string $name): Room
    {
        try {
            $room = $this->repository->byId($roomId);
        } catch (EntityNotFoundException $exception) {
            $room = $this->createRoomService->create($roomId, $name);
        }

        return $room;
    }
}