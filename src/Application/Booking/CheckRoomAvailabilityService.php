<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Domain\Model\Booking\BookingRepositoryInterface;
use App\Infrastructure\Exception\BookingNotAvailableException;

class CheckRoomAvailabilityService
{
    private BookingRepositoryInterface $repository;

    public function __construct(BookingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CheckRoomAvailabilityRequest $request
     * @throws BookingNotAvailableException
     */
    public function execute(CheckRoomAvailabilityRequest $request)
    {
        $available = $this->repository->checkAvailability(
            $request->getRoomId(),
            $request->getArrival(),
            $request->getDeparture()
        );

        if (false === $available) {
            throw new BookingNotAvailableException();
        }
    }
}