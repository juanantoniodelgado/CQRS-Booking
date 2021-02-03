<?php

declare(strict_types=1);

namespace App\Application\Booking;

class CreateBookingService
{
    /** @var CheckRoomAvailabilityService  */
    private $isFreeService;

    /**
     * CreateBookingService constructor.
     * @param CheckRoomAvailabilityService $isFreeService
     */
    public function __construct(CheckRoomAvailabilityService $isFreeService)
    {
        $this->isFreeService = $isFreeService;
    }

    /**
     * @param CreateBookingRequest $request
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

        // true se guarda
        // false se tira excepcion de que no esta disponible
    }
}