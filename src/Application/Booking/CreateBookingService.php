<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Infrastructure\Exception\InvalidParameterException;

class CreateBookingService
{
    private CheckRoomAvailabilityService $isFreeService;

    /**
     * CreateBookingService constructor.
     *
     * @param CheckRoomAvailabilityService $isFreeService
     */
    public function __construct(CheckRoomAvailabilityService $isFreeService)
    {
        $this->isFreeService = $isFreeService;
    }

    /**
     * @param CreateBookingRequest $request
     *
     * @throws InvalidParameterException
     */
    public function create(CreateBookingRequest $request)
    {
        $bool = $this->isFreeService->check(new CheckRoomAvailabilityRequest(
                $request->getRoomId(),
                $request->getRoomName(),
                $request->getArrival(),
                $request->getDeparture()
            )
        );

        // if true stores value
        // if false throws bookingNotAvailableException
    }
}