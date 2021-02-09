<?php

declare(strict_types=1);

namespace App\Domain\Model\Booking;

use \DateTimeImmutable;
use App\Domain\Model\User\User;
use App\Domain\Model\Room\Room;
use App\Infrastructure\Exception\InvalidParameterException;
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
    private int $id;

    /**
     * @var User $client
     *
     * @ORM\OneToMany(targetEntity="App\Domain\Model\User\User", mappedBy="id")
     */
    private User $client;

    /**
     * @var Room $room
     *
     * @ORM\OneToMany(targetEntity="App\Domain\Model\Room\Room", mappedBy="id")
     */
    private Room $room;

    /**
     * @var DateTimeImmutable $arrival
     *
     * @ORM\Column(name="arrival", type="datetime_immutable")
     */
    private DateTimeImmutable $arrival;

    /**
     * @var DateTimeImmutable $departure
     *
     * @ORM\Column(name="departure", type="datetime_immutable")
     */
    private DateTimeImmutable $departure;

    /**
     * Booking constructor.
     *
     * @param User $client
     * @param Room $room
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     *
     * @throws InvalidParameterException
     */
    public function __construct(User $client, Room $room, DateTimeImmutable $arrival, DateTimeImmutable $departure)
    {
        $this->client = $client;
        $this->room = $room;
        $this->arrival = $arrival;

        $this->setDeparture($departure);
    }

    /**
     * @param DateTimeImmutable $departure
     *
     * @throws InvalidParameterException
     */
    public function setDeparture(DateTimeImmutable $departure)
    {
        if ($this->arrival >= $departure) {
            throw new InvalidParameterException('');
        }

        $this->departure = $departure;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getClient(): User
    {
        return $this->client;
    }

    /**
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getArrival(): DateTimeImmutable
    {
        return $this->arrival;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDeparture(): DateTimeImmutable
    {
        return $this->departure;
    }
}