<?php

declare(strict_types=1);

namespace App\Domain\Model\Room;

interface RoomRepository
{
    public function byId(int $roomId): Room;

    public function save(Room $room): void;
}