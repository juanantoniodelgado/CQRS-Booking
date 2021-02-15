<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Model\Room;
use App\Domain\Repository\RoomRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\WritingException;
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
}
