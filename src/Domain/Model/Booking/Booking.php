<?php

declare(strict_types=1);

namespace App\Domain\Model\Booking;

use App\Domain\Model\User\User;
use App\Domain\Model\Room\Room;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Booking
 * @package App\Domain\Model\Booking
 *
 * @ORM\Entity()
 * @ORM\Table(name="booking")
 */
class Booking
{
    /**
     * @var int $id
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User $client
     *
     * @ORM\OneToMany(targetEntity="App\Domain\Model\User\User", mappedBy="id")
     */
    private $client;

    /**
     * @var Room $room
     *
     * @ORM\OneToMany(targetEntity="App\Domain\Model\Room\Room", mappedBy="id" )
     */
    private $room;

    /**
     * @var \DateTimeImmutable $arrival
     *
     * @ORM\Column(name="arrival", type="datetime_immutable")
     */
    private $arrival;

    /**
     * @var \DateTimeImmutable $departure
     *
     * @ORM\Column(name="departure", type="datetime_immutable")
     */
    private $departure;
}