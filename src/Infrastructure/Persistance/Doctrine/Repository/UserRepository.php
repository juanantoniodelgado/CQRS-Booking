<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistance\Doctrine\Repository;

use App\Domain\Model\User\User;
use App\Domain\Model\User\UserRepositoryInterface;
use App\Infrastructure\Exception\EntityNotFoundException;
use Doctrine\ORM\UnexpectedResultException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return User
     *
     * @throws EntityNotFoundException
     */
    public function byId(int $userId): User
    {
        try {

            return $this->getEntityManager()->createQueryBuilder('u')
                ->andWhere('u.id = :val')
                ->setParameter('val', $userId)
                ->getQuery()
                ->getSingleResult()
            ;

        } catch (UnexpectedResultException) {

            throw new EntityNotFoundException();
        }
    }
}