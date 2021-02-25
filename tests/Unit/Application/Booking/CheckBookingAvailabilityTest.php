<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Booking;

use \DateTimeImmutable;
use App\Application\Booking\CheckRoomAvailabilityRequest;
use App\Application\Booking\CheckRoomAvailabilityService;
use App\Domain\Repository\BookingRepositoryInterface;
use App\Infrastructure\Exception\InvalidParameterException;
use App\Tests\Unit\Domain\RoomMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CheckBookingAvailabilityTest extends TestCase
{
    private MockObject $bookingRepository;
    private CheckRoomAvailabilityService $service;

    public function setUp(): void
    {
        $this->bookingRepository = $this->createMock(BookingRepositoryInterface::class);
        $this->service = new CheckRoomAvailabilityService($this->bookingRepository);
    }

    /**
     *
     * @throws InvalidParameterException
     */
    public function testCorrectCheck()
    {
        //TODO
        $room = RoomMother::random();

        $request = new CheckRoomAvailabilityRequest(
            $room->getId(),
            new DateTimeImmutable(),
            new DateTimeImmutable()
        );

        $this->bookingRepository->expects($this->any())
            ->method('checkAvailability')
            ->willReturn(true);

        $this->assertTrue(true);
    }
}