<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Booking;

use \DateTimeImmutable;
use App\Application\Booking\CheckRoomAvailabilityRequest;
use App\Application\Booking\CheckRoomAvailabilityService;
use App\Application\Room\CheckOrAddRoomService;
use App\Domain\Model\Booking\BookingRepository;
use App\Domain\Model\Room\RoomRepository;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Tests\Unit\Domain\RoomMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\UnexpectedResultException;


class CheckRoomAvailabilityTest extends TestCase
{
    private MockObject|RoomRepository $roomRepository;
    private MockObject|CheckOrAddRoomService $checkOrAddRoomService;

    private CheckRoomAvailabilityService $service;

    public function setUp(): void
    {
        $this->roomRepository = $this->createMock(RoomRepository::class);
        $this->checkOrAddRoomService = $this->createMock(CheckOrAddRoomService::class);
        $this->service = new CheckRoomAvailabilityService(
            $this->createMock(BookingRepository::class),
            $this->checkOrAddRoomService
        );
    }

    /**
     * @test
     */
    public function testCorrectCheck()
    {
        $room = RoomMother::random();

        $this->roomRepository->expects($this->any())
            ->method('byId')
            ->willReturn($room);

        $request = new CheckRoomAvailabilityRequest(
            $room->getId(),
            $room->getName(),
            new DateTimeImmutable(),
            new DateTimeImmutable()
        );

        $this->assertTrue($this->service->check($request));
    }

    public function testWrongCheck()
    {
        $room = RoomMother::random();

        $this->checkOrAddRoomService
            ->expects($this->once())
            ->method('check');

        $request = new CheckRoomAvailabilityRequest(
            $room->getId(),
            $room->getName(),
            new DateTimeImmutable(),
            new DateTimeImmutable()
        );

        $this->expectException(EntityNotFoundException::class);
        $this->service->check($request);
    }
}