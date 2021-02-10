<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistance\Doctrine\Repository;

use App\Domain\Model\User\User;
use App\Domain\Model\User\UserRepositoryInterface;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\WritingException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\UnexpectedResultException;

class UserRepository extends EntityRepository implements UserRepositoryInterface
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

    /**
     * @param User $user
     *
     * @throws WritingException
     */
    public function save(User $user): void
    {
        try {
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();
        } catch (ORMException) {
            throw new WritingException();
        }
    }
}