<?php

declare(strict_types=1);

namespace App\Application\Booking;

use \DateTimeImmutable;

class AddBookingRequest
{
    private int $bookingId;
    private int $userId;
    private string $userName;
    private int $roomId;
    private string $roomName;
    private DateTimeImmutable $arrival;
    private DateTimeImmutable $departure;

    /**
     * @param int $bookingId
     * @param int $userId
     * @param string $userName
     * @param int $roomId
     * @param string $roomName
     * @param DateTimeImmutable $arrival
     * @param DateTimeImmutable $departure
     */
    public function __construct(
        int $bookingId,
        int $userId,
        string $userName,
        int $roomId,
        string $roomName,
        DateTimeImmutable $arrival,
        DateTimeImmutable $departure
    ) {
        $this->bookingId = $bookingId;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->roomId = $roomId;
        $this->roomName = $roomName;
        $this->arrival = $arrival;
        $this->departure = $departure;
    }

    /**
     * @return int
     */
    public function getBookingId(): int
    {
        return $this->bookingId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
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
