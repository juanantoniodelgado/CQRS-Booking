<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Application\Room\GetOrAddRoomService;
use App\Domain\Model\Booking\BookingRepository;
use App\Infrastructure\Exception\InvalidParameterException;

class CheckRoomAvailabilityService
{
    private BookingRepository $bookingRepository;
    private GetOrAddRoomService $getOrAddRoom;

    public function __construct(
        BookingRepository $bookingRepository,
        GetOrAddRoomService $checkRoomExists
    ){
        $this->bookingRepository = $bookingRepository;
        $this->getOrAddRoom = $checkRoomExists;
    }

    /**
     * @param CheckRoomAvailabilityRequest $request
     * @return bool
     * @throws InvalidParameterException
     */
    public function check(CheckRoomAvailabilityRequest $request) : bool
    {
        $this->getOrAddRoom->check($request->getRoomId(), $request->getName());

        return $this->bookingRepository->checkAvailability(
            $request->getRoomId(),
            $request->getArrival(),
            $request->getDeparture()
        );
    }
}