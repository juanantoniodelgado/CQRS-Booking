<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Room;

use App\Application\Booking\CheckRoomAvailabilityRequest;
use App\Application\Room\AddRoomService;
use App\Application\Room\CheckOrAddRoomService;
use App\Domain\Model\Room\Room;
use App\Domain\Model\Room\RoomRepository;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Tests\Unit\Domain\RoomMother;
use PHPUnit\Framework\TestCase;

class CheckOrAddRoomServiceTest extends TestCase
{
    private $roomRepository;
    private $addRoomService;
    private $service;

    public function setUp() : void
    {
        $this->roomRepository = $this->createMock(RoomRepository::class);
        $this->addRoomService = $this->createMock(AddRoomService::class);

        $this->service = new CheckOrAddRoomService(
            $this->roomRepository,
            $this->addRoomService
        );
    }

    /**
     * @test
     */
    public function testAddCheck()
    {
        $room = RoomMother::random();

        $this->roomRepository->expects($this->any())
            ->method('byId')
            ->willThrowException(new EntityNotFoundException());

        $this->addRoomService->expects($this->any())
            ->method('create')
            ->willReturn($room);

        $result = $this->service->check($room->getId(), $room->getName());

        $this->assertSame($result, $room);
    }

    /**
     * @test
     */
    public function testGetCheck()
    {
        $room = RoomMother::random();

        $this->roomRepository->expects($this->any())
            ->method('byId')
            ->willReturn($room);

        $result = $this->service->check($room->getId(), $room->getName());

        $this->assertSame($result, $room);
    }
}