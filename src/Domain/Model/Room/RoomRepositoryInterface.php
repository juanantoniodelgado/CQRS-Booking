<?php

declare(strict_types=1);

namespace App\Domain\Model\Room;

use App\Domain\Model\BaseRepositoryInterface;
use App\Infrastructure\Exception\EntityNotFoundException;

interface RoomRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $roomId
     * @throws EntityNotFoundException
     * @return Room
     */
    public function byId(int $roomId): Room;
}