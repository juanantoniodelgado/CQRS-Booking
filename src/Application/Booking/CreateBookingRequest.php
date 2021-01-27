<?php

declare(strict_types=1);

namespace App\Application\Booking;

class CreateBookingRequest
{
    private $userId;

    private $roomId;

    private $arrival;

    private $departure;

    /**
     * CreateBookingRequest constructor.
     * @param int $userId
     * @param int $roomId
     * @param \DateTimeImmutable $arrival
     * @param \DateTimeImmutable $departure
     */
    public function __construct(int $userId, int $roomId, \DateTimeImmutable $arrival, \DateTimeImmutable $departure)
    {
        $this->userId = $userId;
        $this->roomId = $roomId;
        $this->arrival = $arrival;
        $this->departure = $departure;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
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