<?php

declare(strict_types=1);

namespace App\Application\Room;

use App\Infrastructure\Persistence\Doctrine\Repository\RoomRepository;
use DateTimeImmutable;

class GetAvailableRoomsService
{
    private RoomRepository $roomRepository;

    /**
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     *
     * @return array
     */
    public function execute(DateTimeImmutable $arrival, DateTimeImmutable $departure): array
    {
        return $this->roomRepository->getAvailableRooms($arrival, $departure);
    }

    public function __construct(RoomRepository $repository)
    {
        $this->roomRepository = $repository;
    }
}
