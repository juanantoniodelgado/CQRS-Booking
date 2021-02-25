<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Room;

use App\Tests\Unit\Domain\RoomMother;
use \DateTime;
use \DateTimeImmutable;
use App\Application\Room\GetAvailableRoomsService;
use App\Domain\Model\Room;
use App\Infrastructure\Persistence\Doctrine\Repository\RoomRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetAvailableRoomTest extends TestCase
{
    private GetAvailableRoomsService $service;

    private MockObject|RoomRepository $roomRepository;

    /**
     * @test
     * @throws \Exception
     */
    public function testGetSomeRooms()
    {
        $rooms = RoomMother::randomArray();

        $this->roomRepository->expects($this->once())
            ->method('getAvailableRooms')
            ->willReturn($rooms);

        $arrival = new DateTimeImmutable();
        $departure = new \DateTime('+1 day');
        $departure = new \DateTimeImmutable($departure->format(\DateTimeImmutable::ATOM));

        $rooms = $this->service->execute($arrival, $departure);

        $this->assertNotNull($rooms);
        foreach ($rooms as $room) {
            $this->assertInstanceOf(Room::class, $room);
        }
    }

    public function testNotRoomsAvailable()
    {
        $this->roomRepository->expects($this->once())
            ->method('getAvailableRooms')
            ->willReturn([]);

        $arrival = new DateTimeImmutable();
        $departure = new \DateTime('+1 day');
        $departure = new \DateTimeImmutable($departure->format(\DateTimeImmutable::ATOM));

        $rooms = $this->service->execute($arrival, $departure);

        $this->assertNotNull($rooms);
        $this->assertSame(0, sizeof($rooms));
    }

    public function setUp(): void
    {
        $this->roomRepository = $this->createMock(RoomRepository::class);
        $this->service = new GetAvailableRoomsService(
            $this->roomRepository
        );
    }
}