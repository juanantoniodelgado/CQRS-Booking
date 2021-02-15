<?php

declare(strict_types=1);

namespace App\Domain\Model;

use \DateTimeImmutable;
use App\Infrastructure\Exception\InvalidParameterException;

class Booking
{
    private int $id;
    private User $client;
    private Room $room;
    private DateTimeImmutable $arrival;
    private DateTimeImmutable $departure;

    /**
     * @param int $id
     * @param User $client
     * @param Room $room
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     *
     * @throws InvalidParameterException
     */
    public function __construct(
        int $id,
        User $client,
        Room $room,
        DateTimeImmutable $arrival,
        DateTimeImmutable $departure
    ) {
        $this->id = $id;
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
