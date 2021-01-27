<?php

declare(strict_types=1);

namespace App\Domain\Model\Room;

interface RoomRepository
{
    public function findRoomById(int $roomId);
}