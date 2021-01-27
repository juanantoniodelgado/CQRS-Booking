<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\User;

use App\Domain\Model\User\UserRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    private $em;

    public function __constructor()
    {
        $this->em = $this->getEntityManager();
    }

    public function findUserById(int $userId)
    {
        return $this->em->findById($userId);
    }
}