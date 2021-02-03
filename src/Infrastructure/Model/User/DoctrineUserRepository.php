<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\User;

use App\Domain\Model\User\User;
use App\Domain\Model\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\UnexpectedResultException;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->em = $this->getEntityManager();
    }

    /**
     * @param int $userId
     * @return User
     * @throws UnexpectedResultException
     */
    public function findUserById(int $userId): User
    {
        return $this->em->createQueryBuilder('u')
            ->andWhere('u.id = :val')
            ->setParameter('val', $userId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}