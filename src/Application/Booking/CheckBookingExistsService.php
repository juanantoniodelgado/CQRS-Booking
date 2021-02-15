<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Domain\Model\Booking\BookingRepositoryInterface;
use App\Infrastructure\Exception\BookingAlreadyExists;
use App\Infrastructure\Exception\EntityNotFoundException;

class CheckBookingExistsService
{
    private BookingRepositoryInterface $repository;

    public function __construct(BookingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $bookingId
     *
     * @return void
     *
     * @throws BookingAlreadyExists
     */
    public function execute(int $bookingId)
    {
        try {

            $this->repository->byId($bookingId);
            throw new BookingAlreadyExists();

        } catch (EntityNotFoundException) {}
    }
}