<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\Booking;

use \DateTimeImmutable;
use App\Domain\Model\Booking\BookingRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineBookingRepository extends EntityRepository implements BookingRepository
{
    /**
     * @param int $roomId
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     * @return bool
     */
    public function checkAvailability(int $roomId, DateTimeImmutable $arrival, DateTimeImmutable $departure) : bool
    {

    }
}