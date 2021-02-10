<?php

declare(strict_types=1);

namespace App\Application\Booking;

use App\Application\Room\GetRoomService;
use App\Application\User\GetUserService;
use App\Domain\Model\Booking\Booking;
use App\Domain\Model\Booking\BookingRepositoryInterface;
use App\Infrastructure\Exception\BookingNotAvailableException;
use App\Infrastructure\Exception\InvalidParameterException;
use App\Infrastructure\Exception\WritingException;

class AddBookingService
{
    private GetRoomService $roomService;
    private GetUserService $userService;
    private BookingRepositoryInterface $repository;
    private CheckRoomAvailabilityService $availabilityService;

    /**
     * AddBookingService constructor.
     * @param GetRoomService $roomService
     * @param GetUserService $userService
     * @param CheckRoomAvailabilityService $availability
     * @param BookingRepositoryInterface $bookingRepository
     */
    public function __construct(
        GetRoomService $roomService,
        GetUserService $userService,
        CheckRoomAvailabilityService $availability,
        BookingRepositoryInterface $bookingRepository
    ){
        $this->roomService = $roomService;
        $this->userService = $userService;
        $this->availabilityService = $availability;
        $this->repository = $bookingRepository;
    }

    /**
     * @param AddBookingRequest $request
     *
     * @return Booking
     *
     * @throws BookingNotAvailableException
     * @throws InvalidParameterException
     * @throws WritingException
     */
    public function execute(AddBookingRequest $request): Booking
    {
        $room = $this->roomService->execute($request->getRoomId(), $request->getRoomName());

        $isAvailable = $this->availabilityService->execute(new CheckRoomAvailabilityRequest(
                $room->getId(),
                $request->getArrival(),
                $request->getDeparture()
            )
        );

        if (!$isAvailable) {
            throw new BookingNotAvailableException();
        }

        $client = $this->userService->execute($request->getUserId(), $request->getUserName());

        $booking = new Booking(
            $client,
            $room,
            $request->getArrival(),
            $request->getDeparture()
        );

        $this->repository->save($booking);

        return $booking;
    }
}