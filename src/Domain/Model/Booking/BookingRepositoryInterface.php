<?php

declare(strict_types=1);

namespace App\Domain\Model\Booking;

use \DateTimeImmutable;
use App\Domain\Model\BaseRepositoryInterface;
use App\Infrastructure\Exception\WritingException;

interface BookingRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $roomId
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     *
     * @return bool
     */
    public function checkAvailability(
        int $roomId,
        DateTimeImmutable $arrival,
        DateTimeImmutable $departure
    ): bool;
}