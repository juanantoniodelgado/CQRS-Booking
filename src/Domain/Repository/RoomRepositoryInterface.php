<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Room;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\WritingException;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;

interface RoomRepositoryInterface
{
    /**
     * @param int $roomId
     *
     * @throws EntityNotFoundException
     *
     * @return Room
     */
    public function byId(int $roomId): Room;

    /**
     * @param Room $room
     *
     * @return void
     *
     * @throws WritingException
     */
    public function save(Room $room): void;

    /**
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     * @return array
     */
    public function getAvailableRooms(DateTimeImmutable $arrival, DateTimeImmutable $departure): array;
}
