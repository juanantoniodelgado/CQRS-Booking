<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Application\Room\CheckOrAddRoomService;
use App\Domain\Model\Booking\BookingRepository;

class CheckRoomAvailabilityService
{
    private BookingRepository $bookingRepository;
    private CheckOrAddRoomService $checkRoomExists;

    public function __construct(
        BookingRepository $bookingRepository,
        CheckOrAddRoomService $checkRoomExists
    ){
        $this->bookingRepository = $bookingRepository;
        $this->checkRoomExists = $checkRoomExists;
    }

    /**
     * @param CheckRoomAvailabilityRequest $request
     * @return bool
     */
    public function check(CheckRoomAvailabilityRequest $request) : bool
    {
        $room = $this->checkRoomExists->check(
            $request->getRoomId(),
            $request->getName()
        );

        return $this->bookingRepository->checkAvailability(
            $request->getRoomId(),
            $request->getArrival(),
            $request->getDeparture()
        );

        return true;
    }
}