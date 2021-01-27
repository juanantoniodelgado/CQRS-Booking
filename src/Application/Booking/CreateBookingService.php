<?php

declare(strict_types=1);

namespace App\Application\Booking;

class CreateBookingService
{
    /** @var CheckBookingIsFreeService  */
    private $checker;

    /**
     * CreateBookingService constructor.
     * @param CheckBookingIsFreeService $checker
     */
    public function __construct(CheckBookingIsFreeService $checker)
    {
        $this->checker = $checker;
    }

    /**
     * @param CreateBookingRequest $request
     */
    public function create(CreateBookingRequest $request)
    {
        $this->checker->check(new CheckBookingIsFreeRequest(
                $request->getRoomId(),
                $request->getArrival(),
                $request->getDeparture()
            )
        );
    }
}