<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Model\Room\Room;
use App\Domain\Model\Room\RoomRepositoryInterface;
use App\Infrastructure\Exception\EntityNotFoundException;
use Doctrine\ORM\UnexpectedResultException;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
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
}