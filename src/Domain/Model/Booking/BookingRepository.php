<?php

declare(strict_types=1);

namespace App\Domain\Model\Booking;

interface BookingRepository
{
    public function checkAvailability(
        int $roomId,
        \DateTimeImmutable $arrival,
        \DateTimeImmutable $departure
    ) : bool;
}