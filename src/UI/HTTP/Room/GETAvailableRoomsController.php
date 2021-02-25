<?php


namespace App\UI\HTTP\Room;

use App\Application\Room\GetAvailableRoomsService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class GETAvailableRoomsController extends AbstractFOSRestController
{
    private GetAvailableRoomsService $getAvailableRoomsService;

    /**
     * @Rest\Get("/rooms_available/{arrival}/{departure}")
     *
     * @param string $arrival
     * @param string $departure
     *
     * @return Response
     * @throws \Exception
     */
    public function getAvailableRooms(string $arrival, string $departure): Response
    {
        $rooms = $this->getAvailableRoomsService->execute(
            new \DateTimeImmutable($arrival),
            new \DateTimeImmutable($departure)
        );

        return $this->handleView(View::create($rooms, 200));
    }

    public function __construct(GetAvailableRoomsService $getAvailableRoomsService)
    {
        $this->getAvailableRoomsService = $getAvailableRoomsService;
    }
}