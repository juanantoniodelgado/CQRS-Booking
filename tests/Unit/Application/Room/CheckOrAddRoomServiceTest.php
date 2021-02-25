<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Room;

use App\Application\Room\AddRoomService;
use App\Application\Room\GetRoomService;
use App\Domain\Repository\RoomRepositoryInterface;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\InvalidParameterException;
use App\Tests\Unit\Domain\RoomMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CheckOrAddRoomServiceTest extends TestCase
{
    private MockObject $roomRepository;
    private MockObject $addRoomService;
    private GetRoomService $getRoomService;

    public function setUp() : void
    {
        $this->roomRepository = $this->createMock(RoomRepositoryInterface::class);
        $this->addRoomService = $this->createMock(AddRoomService::class);

        $this->getRoomService = new GetRoomService(
            $this->addRoomService,
            $this->roomRepository
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
            ->method('execute')
            ->willReturn($room);

        $result = $this->getRoomService->execute($room->getId(), $room->getName());

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

        $result = $this->getRoomService->execute($room->getId(), $room->getName());

        $this->assertSame($result, $room);
    }
}