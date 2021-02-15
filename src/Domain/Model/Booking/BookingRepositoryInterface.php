<?php

declare(strict_types=1);

namespace App\Domain\Model\Booking;

use \DateTimeImmutable;
use App\Domain\Model\Booking;
use App\Infrastructure\Exception\WritingException;

interface BookingRepositoryInterface
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

    /**
     * @param Booking $booking
     *
     * @return void
     *
     * @throws WritingException
     */
    public function save(Booking $booking): void;
}