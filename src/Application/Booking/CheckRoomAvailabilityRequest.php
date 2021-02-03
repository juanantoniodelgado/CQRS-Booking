<?php

declare(strict_types=1);

namespace App\Application\Booking;

use \DateTimeImmutable;

class CheckRoomAvailabilityRequest
{
    private int $roomId;
    private string $name;
    private DateTimeImmutable $arrival;
    private DateTimeImmutable $departure;

    /**
     * CheckBookingIsFreeRequest constructor.
     *
     * @param int $roomId
     * @param string $name
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     */
    public function __construct(
        int $roomId,
        string $name,
        DateTimeImmutable $arrival,
        DateTimeImmutable $departure
    ){
        $this->roomId = $roomId;
        $this->name = $name;
        $this->arrival = $arrival;
        $this->departure = $departure;
    }

    /**
     * @return int
     */
    public function getRoomId(): int
    {
        return $this->roomId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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