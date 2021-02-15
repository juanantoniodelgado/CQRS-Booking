<?php

declare(strict_types=1);

namespace App\UI\HTTP\Booking;

use \Exception;
use \DateTimeImmutable;
use App\Application\Booking\AddBookingRequest;
use App\Application\Booking\AddBookingService;
use App\Infrastructure\Exception\BookingAlreadyExists;
use App\Infrastructure\Exception\BookingNotAvailableException;
use App\Infrastructure\Exception\InvalidParameterException;
use App\Infrastructure\Exception\WritingException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class POSTBookingController extends AbstractFOSRestController
{
    private AddBookingService $addBookingService;

    /**
     * @Rest\Post("/booking")
     *
     * @Rest\RequestParam(name="booking_id", nullable=false, requirements="\d+")
     * @Rest\RequestParam(name="booking_arrival", nullable=false)
     * @Rest\RequestParam(name="booking_departure", nullable=false)
     * @Rest\RequestParam(name="user_id", nullable=false, requirements="\d+")
     * @Rest\RequestParam(name="user_name", nullable=false)
     * @Rest\RequestParam(name="room_id", nullable=false, requirements="\d+")
     * @Rest\RequestParam(name="room_name", nullable=false)
     *
     * @param ParamFetcherInterface $fetcher
     *
     * @return Response
     *
     * @throws InvalidParameterException
     * @throws BookingAlreadyExists
     * @throws BookingNotAvailableException
     * @throws WritingException
     * @throws Exception
     */
    public function create(ParamFetcherInterface $fetcher): Response
    {
        $this->addBookingService->execute(
            new AddBookingRequest(
                (int) $fetcher->get('booking_id'),
                (int) $fetcher->get('user_id'),
                $fetcher->get('user_name'),
                (int) $fetcher->get('room_id'),
                $fetcher->get('room_name'),
                new DateTimeImmutable($fetcher->get('booking_arrival')),
                new DateTimeImmutable($fetcher->get('booking_departure')),
            )
        );

        return $this->handleView(View::create(null, 200));
    }

    public function __construct(AddBookingService $service)
    {
        $this->addBookingService = $service;
    }
}