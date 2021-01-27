<?php

declare(strict_types=1);

namespace App\Application\Room;

use App\Domain\Model\Room\Room;

class CheckOrAddRoomService
{
    public function check(int $roomId): Room
    {
        //query to check if room exists

        //if not, add new room

        //return found or created room object
    }
}