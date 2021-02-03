<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\Room;

use App\Domain\Model\Room\Room;
use App\Domain\Model\Room\RoomRepository;
use App\Infrastructure\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\UnexpectedResultException;

class DoctrineRoomRepository extends EntityRepository implements RoomRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->em = $this->getEntityManager();
    }

    /**
     * @param int $roomId
     * @return Room
     * @throws EntityNotFoundException
     */
    public function byId(int $roomId): Room
    {
        try {

            return $this->em->createQueryBuilder('r')
                ->andWhere('r.id = :val')
                ->setParameter('val', $roomId)
                ->getQuery()
                ->getSingleResult()
            ;

        } catch (UnexpectedResultException $exception) {

            throw new EntityNotFoundException();
        }
    }

    /**
     * @param Room $room
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(Room $room): void
    {
        $this->em->persist($room);
        $this->em->flush();
    }
}