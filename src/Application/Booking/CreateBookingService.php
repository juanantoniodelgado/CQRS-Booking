<?php

declare(strict_types=1);

namespace App\Application\Booking;

class CreateBookingService
{
    /** @var CheckBookingIsFreeService  */
    private $isFreeService;

    /**
     * CreateBookingService constructor.
     * @param CheckBookingIsFreeService $isFreeService
     */
    public function __construct(CheckBookingIsFreeService $isFreeService)
    {
        $this->isFreeService = $isFreeService;
    }

    /**
     * @param CreateBookingRequest $request
     */
    public function create(CreateBookingRequest $request)
    {
        $this->isFreeService->check(new CheckBookingIsFreeRequest(
                $request->getRoomId(),
                $request->getArrival(),
                $request->getDeparture()
            )
        );
    }
}