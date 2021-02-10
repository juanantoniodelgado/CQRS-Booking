<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistance\Doctrine\Repository;

use \DateTimeImmutable;
use App\Domain\Model\Booking\Booking;
use App\Domain\Model\Booking\BookingRepositoryInterface;
use App\Infrastructure\Exception\WritingException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;

class BookingRepository extends EntityRepository implements BookingRepositoryInterface
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

    /**
     * @param Booking $booking
     *
     * @return void
     *
     * @throws WritingException
     */
    public function save(Booking $booking): void
    {
        try {
            $this->getEntityManager()->flush();
            $this->getEntityManager()->persist($booking);
        } catch (ORMException) {
            throw new WritingException();
        }
    }
}