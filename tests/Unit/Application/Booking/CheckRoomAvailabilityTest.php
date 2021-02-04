<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Booking;

use \DateTimeImmutable;
use App\Application\Booking\CheckRoomAvailabilityRequest;
use App\Application\Booking\CheckRoomAvailabilityService;
use App\Application\Room\GetOrAddRoomService;
use App\Domain\Model\Booking\BookingRepository;
use App\Infrastructure\Exception\InvalidParameterException;
use App\Tests\Unit\Domain\RoomMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CheckRoomAvailabilityTest extends TestCase
{
    private MockObject $bookingRepository;
    private CheckRoomAvailabilityService $service;

    public function setUp(): void
    {
        $this->bookingRepository = $this->createMock(BookingRepository::class);

        $this->service = new CheckRoomAvailabilityService(
            $this->bookingRepository,
            $this->createMock(GetOrAddRoomService::class)
        );
    }

    /**
     * @test
     * @throws InvalidParameterException
     */
    public function testCorrectCheck()
    {
        $room = RoomMother::random();

        $request = new CheckRoomAvailabilityRequest(
            $room->getId(),
            $room->getName(),
            new DateTimeImmutable(),
            new DateTimeImmutable()
        );

        $this->bookingRepository->expects($this->any())
            ->method('checkAvailability')
            ->willReturn(true);

        $this->assertTrue($this->service->check($request));
    }
}