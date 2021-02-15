<?php

declare(strict_types=1);

namespace App\Application\Booking;

use \DateTimeImmutable;

class CheckRoomAvailabilityRequest
{
    private int $roomId;
    private DateTimeImmutable $arrival;
    private DateTimeImmutable $departure;

    /**
     * @param int $roomId
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     */
    public function __construct(
        int $roomId,
        DateTimeImmutable $arrival,
        DateTimeImmutable $departure
    ) {
        $this->roomId = $roomId;
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
