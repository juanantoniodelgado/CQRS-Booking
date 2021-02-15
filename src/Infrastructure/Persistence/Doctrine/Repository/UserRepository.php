<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Model\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\WritingException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\UnexpectedResultException;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

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
            return $this->getEntityManager()->createQueryBuilder()
                ->select('u')
                ->from(User::class, 'u')
                ->where('u.id = :val')
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
     * @return void
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
