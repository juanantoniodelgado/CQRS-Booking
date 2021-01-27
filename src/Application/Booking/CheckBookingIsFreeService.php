<?php

declare(strict_types=1);

namespace App\Application\Booking;

class CheckBookingIsFreeService
{
    private $bookingRepository;


    public function __construct(BookingRepository $bookingRepository){
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @param CheckBookingIsFreeRequest $request
     * @return bool
     */
    public function check(CheckBookingIsFreeRequest $request) : bool
    {
        //TODO: COMPROBAR QUE LA HABITACION EXISTA ANTES DE COMPROBAR DISPONIBILIDAD


        return $this->bookingRepository->checkAvailability(
            $request->getRoomId(),
            $request->getArrival(),
            $request->getDeparture()
        );
    }
}