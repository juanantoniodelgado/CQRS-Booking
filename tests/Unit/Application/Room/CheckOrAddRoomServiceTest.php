<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Room;

use App\Application\Room\AddRoomService;
use App\Application\Room\GetOrAddRoomService;
use App\Domain\Model\Room\RoomRepository;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\InvalidParameterException;
use App\Tests\Unit\Domain\RoomMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CheckOrAddRoomServiceTest extends TestCase
{
    private MockObject $roomRepository;
    private MockObject $addRoomService;
    private GetOrAddRoomService $getRoomService;

    public function setUp() : void
    {
        $this->roomRepository = $this->createMock(RoomRepository::class);
        $this->addRoomService = $this->createMock(AddRoomService::class);

        $this->getRoomService = new GetOrAddRoomService(
            $this->roomRepository,
            $this->addRoomService
        );
    }

    /**
     * @test
     *
     * @throws InvalidParameterException
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

        $result = $this->getRoomService->check($room->getId(), $room->getName());

        $this->assertSame($result, $room);
    }

    /**
     * @test
     *
     * @throws InvalidParameterException
     */
    public function testGetCheck()
    {
        $room = RoomMother::random();

        $this->roomRepository->expects($this->any())
            ->method('byId')
            ->willReturn($room);

        $result = $this->getRoomService->check($room->getId(), $room->getName());

        $this->assertSame($result, $room);
    }
}