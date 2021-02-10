<?php

declare(strict_types=1);

namespace App\Domain\Model\Room;

use App\Infrastructure\Exception\EntityNotFoundException;

interface RoomRepositoryInterface
{
    /**
     * @param int $roomId
     * @throws EntityNotFoundException
     * @return Room
     */
    public function byId(int $roomId): Room;

    public function save(Room $room): void;
}