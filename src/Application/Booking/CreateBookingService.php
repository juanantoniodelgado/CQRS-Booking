<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Domain\Model\Booking\Booking;
use App\Infrastructure\Exception\BookingNotAvailableException;
use App\Infrastructure\Exception\InvalidParameterException;

class CreateBookingService
{
    private CheckRoomAvailabilityService $availabilityService;

    /**
     * CreateBookingService constructor.
     *
     * @param CheckRoomAvailabilityService $service
     */
    public function __construct(CheckRoomAvailabilityService $service)
    {
        $this->availabilityService = $service;
    }

    /**
     * @param CreateBookingRequest $request
     *
     * @throws InvalidParameterException
     * @throws BookingNotAvailableException
     */
    public function create(CreateBookingRequest $request): Booking
    {
        $isAvailable = $this->availabilityService->check(new CheckRoomAvailabilityRequest(
                $request->getRoomId(),
                $request->getRoomName(),
                $request->getArrival(),
                $request->getDeparture()
            )
        );

        if (!$isAvailable) {
            throw new BookingNotAvailableException();
        }


//        // if true stores value
//        $booking = new Booking(
//            $request->client,
//            $request->room,
//            $request->getArrival(),
//            $request->getDeparture()
//        );
//
//        $this->repository->save($booking);
//        return $booking;
    }
}