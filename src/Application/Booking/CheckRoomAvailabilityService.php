<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Domain\Model\Booking\BookingRepositoryInterface;

class CheckRoomAvailabilityService
{
    private BookingRepositoryInterface $repository;

    public function __construct(BookingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CheckRoomAvailabilityRequest $request
     *
     * @return bool
     */
    public function execute(CheckRoomAvailabilityRequest $request): bool
    {
        return $this->repository->checkAvailability(
            $request->getRoomId(),
            $request->getArrival(),
            $request->getDeparture(),
        );
    }
}