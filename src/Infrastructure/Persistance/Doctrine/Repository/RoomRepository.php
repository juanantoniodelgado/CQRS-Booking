<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistance\Doctrine\Repository;

use App\Domain\Model\Room\Room;
use App\Domain\Model\Room\RoomRepositoryInterface;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\WritingException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\UnexpectedResultException;

class RoomRepository extends EntityRepository implements RoomRepositoryInterface
{
    /**
     * @param int $roomId
     * @return Room
     * @throws EntityNotFoundException
     */
    public function byId(int $roomId): Room
    {
        try {

            return $this->getEntityManager()->createQueryBuilder('r')
                ->andWhere('r.id = :val')
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