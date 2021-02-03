<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Application\Room\CheckOrAddRoomService;
use App\Domain\Model\Booking\BookingRepository;

class CheckBookingIsFreeService
{
    private $bookingRepository;
    private $checkRoomExists;

    public function __construct(
        BookingRepository $bookingRepository,
        CheckOrAddRoomService $checkRoomExists
    ){
        $this->bookingRepository = $bookingRepository;
        $this->checkRoomExists = $checkRoomExists;
    }

    /**
     * @param CheckBookingIsFreeRequest $request
     * @return bool
     */
    public function check(CheckBookingIsFreeRequest $request) : bool
    {
        $room = $this->checkRoomExists->check($request->getRoomId());

        return $this->bookingRepository->checkAvailability(
            $request->getRoomId(),
            $request->getArrival(),
            $request->getDeparture()
        );
    }
}