<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use \DateTimeImmutable;
use App\Domain\Model\Booking\BookingRepositoryInterface;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    /**
     * @param int $roomId
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     *
     * @return bool
     */
    public function checkAvailability(int $roomId, DateTimeImmutable $arrival, DateTimeImmutable $departure) : bool
    {
        $result = $this->getEntityManager()->createQueryBuilder('b')
            ->where('b.room_id = :roomId')

            // This exclude bookings that are prior and future to the proposed dates.
            ->andWhere('b.departure > arrival AND b.arrival < departure')

            ->andWhere(':arrival BETWEEN b.arrival AND b.departure')
            ->andWhere(':departure BETWEEN b.arrival AND b.departure')

            ->setParameter('roomId', $roomId)
            ->setParameter('arrival', $arrival)
            ->setParameter('departure', $departure)
            ->getQuery()->execute();

        return (is_null($result) || empty($result));
    }
}