<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use \DateTimeImmutable;
use App\Domain\Model\Booking;
use App\Domain\Model\Room;
use App\Domain\Repository\RoomRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\WritingException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\UnexpectedResultException;
use Doctrine\Persistence\ManagerRegistry;

class RoomRepository extends ServiceEntityRepository implements RoomRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

    /**
     * @param int $roomId
     * @return Room
     * @throws EntityNotFoundException
     */
    public function byId(int $roomId): Room
    {
        try {
            return $this->getEntityManager()->createQueryBuilder()
                ->select('r')
                ->from(Room::class, 'r')
                ->where('r.id = :val')
                ->setParameter('val', $roomId)
                ->getQuery()
                ->getSingleResult()
            ;
        } catch (UnexpectedResultException) {
            throw new EntityNotFoundException();
        }
    }


    /**
     * @param Room $room
     *
     * @return void
     *
     * @throws WritingException
     */
    public function save(Room $room): void
    {
        try {
            $this->getEntityManager()->persist($room);
            $this->getEntityManager()->flush();
        } catch (ORMException) {
            throw new WritingException();
        }
    }

    /**
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     * @return array
     */
    public function getAvailableRooms(DateTimeImmutable $arrival, DateTimeImmutable $departure): array
    {
        $expr = $this->getEntityManager()->getExpressionBuilder();

        $result = $this->getEntityManager()->createQueryBuilder()
            ->select('r')
            ->from(Room::class, 'r')
            ->where(
                $expr->notIn(
                    'r.id',
                    $this->getEntityManager()->createQueryBuilder()
                        ->select('IDENTITY(b.room)')
                        ->from(Booking::class, 'b')
                        ->where('b.departure > :arrival AND b.arrival < :departure')
                    ->getDQL()
                )
            )
            ->setParameter('arrival', $arrival)
            ->setParameter('departure', $departure)
            ->getQuery()->execute();

        if ($result instanceof ArrayCollection) {
            $result = $result->toArray();
        }

        return $result;
    }
}
