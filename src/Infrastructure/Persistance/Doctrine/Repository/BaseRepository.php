<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistance\Doctrine\Repository;

use App\Domain\Model\AggregateRoot;
use App\Infrastructure\Exception\WritingException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;

abstract class BaseRepository extends EntityRepository
{
    /**
     * @param AggregateRoot $root
     *
     * @return void
     *
     * @throws WritingException
     */
    public function save(AggregateRoot $root): void
    {
        try {
            $this->getEntityManager()->flush();
            $this->getEntityManager()->persist($root);
        } catch (ORMException) {
            throw new WritingException();
        }
    }
}