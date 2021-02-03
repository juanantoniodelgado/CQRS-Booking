<?php

declare(strict_types=1);

namespace App\Application\Booking;

use \DateTimeImmutable;

class CreateBookingRequest
{
    private int $userId;
    private int $roomId;
    private string $roomName;
    private DateTimeImmutable $arrival;
    private DateTimeImmutable $departure;

    /**
     * CreateBookingRequest constructor.
     *
     * @param int $userId
     * @param int $roomId
     * @param string $roomName
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     */
    public function __construct(
        int $userId,
        int $roomId,
        string $roomName,
        DateTimeImmutable $arrival,
        DateTimeImmutable $departure
    ){
        $this->userId = $userId;
        $this->roomId = $roomId;
        $this->roomName = $roomName;
        $this->arrival = $arrival;
        $this->departure = $departure;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
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
    public function getRoomName(): string
    {
        return $this->roomName;
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