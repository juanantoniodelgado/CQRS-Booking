<?php

declare(strict_types=1);

namespace App\Domain\Model\Room;

use App\Domain\Model\Room;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\WritingException;

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
}