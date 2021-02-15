<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Application\Room\GetRoomService;
use App\Application\User\GetUserService;
use App\Domain\Model\Booking;
use App\Domain\Model\Booking\BookingRepositoryInterface;
use App\Infrastructure\Exception\BookingAlreadyExists;
use App\Infrastructure\Exception\BookingNotAvailableException;
use App\Infrastructure\Exception\InvalidParameterException;
use App\Infrastructure\Exception\WritingException;

class AddBookingService
{
    private GetRoomService $roomService;
    private GetUserService $userService;
    private BookingRepositoryInterface $repository;
    private CheckRoomAvailabilityService $availabilityService;
    private CheckBookingExistsService $existsService;

    /**
     * @param GetRoomService $roomService
     * @param GetUserService $userService
     * @param CheckRoomAvailabilityService $availability
     * @param BookingRepositoryInterface $bookingRepository
     * @param CheckBookingExistsService $existService
     */
    public function __construct(
        GetRoomService $roomService,
        GetUserService $userService,
        CheckRoomAvailabilityService $availability,
        BookingRepositoryInterface $bookingRepository,
        CheckBookingExistsService $existService
    ) {
        $this->roomService = $roomService;
        $this->userService = $userService;
        $this->availabilityService = $availability;
        $this->repository = $bookingRepository;
        $this->existsService = $existService;
    }

    /**
     * @param AddBookingRequest $request
     *
     * @return Booking
     *
     * @throws BookingAlreadyExists
     * @throws BookingNotAvailableException
     * @throws InvalidParameterException
     * @throws WritingException
     */
    public function execute(AddBookingRequest $request): Booking
    {
        $this->existsService->execute($request->getBookingId());

        $room = $this->roomService->execute($request->getRoomId(), $request->getRoomName());

        $this->availabilityService->execute(
            new CheckRoomAvailabilityRequest(
                $room->getId(),
                $request->getArrival(),
                $request->getDeparture()
            )
        );

        $client = $this->userService->execute($request->getUserId(), $request->getUserName());

        $booking = new Booking(
            $request->getBookingId(),
            $client,
            $room,
            $request->getArrival(),
            $request->getDeparture()
        );

        $this->repository->save($booking);

        return $booking;
    }
}
