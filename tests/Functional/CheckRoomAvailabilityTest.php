<?php


namespace App\Tests\Functional;

use \DateTimeImmutable;
use App\Infrastructure\Exception\InvalidParameterException;
use App\Tests\Unit\Domain\BookingMother;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CheckRoomAvailabilityTest extends WebTestCase
{
    /**
     * @test
     * @throws InvalidParameterException
     */
    public function validIntervalTest()
    {
        $booking = BookingMother::random();
        $client = static::createClient();

        $client->request('POST', '/booking', [
            'booking_id' => $booking->getId(),
            'room_id' => $booking->getRoom()->getId(),
            'room_name' => $booking->getRoom()->getName(),
            'user_id' => $booking->getClient()->getId(),
            'user_name' => $booking->getClient()->getName(),
            'booking_arrival' => $booking->getArrival()->format(DateTimeImmutable::ATOM),
            'booking_departure' => $booking->getDeparture()->format(DateTimeImmutable::ATOM)
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}