<?php

declare(strict_types=1);

namespace App\Application\Booking;


class CheckBookingIsFreeRequest
{
    private $roomId;

    private $arrival;

    private $departure;

    /**
     * CheckBookingIsFreeRequest constructor.
     * @param int $roomId
     * @param \DateTimeImmutable $arrival
     * @param \DateTimeImmutable $departure
     */
    public function __construct(int $roomId, \DateTimeImmutable $arrival, \DateTimeImmutable $departure)
    {
        $this->roomId = $roomId;
        $this->arrival = $arrival;
        $this->departure = $departure;
    }

    /**
     * @return int
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDeparture()
    {
        return $this->departure;
    }
}