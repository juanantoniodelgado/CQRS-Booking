<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use \Exception;
use \DateTime;
use \DateTimeImmutable;
use App\Domain\Model\Booking;
use App\Infrastructure\Exception\InvalidParameterException;

class BookingMother
{
    /**
     * @param string|null $arrival
     * @param string|null $departure
     *
     * @return Booking
     *
     * @throws Exception
     * @throws InvalidParameterException
     */
    public static function random(string $arrival = null, string $departure = null): Booking
    {
        if (is_null($arrival)) {

            $arrival = new DateTime('now');
            $arrival = $arrival->modify('+' . rand(1, 10) . ' days')
                ->format(DateTimeImmutable::ATOM);
        }

        $arrival = new DateTimeImmutable($arrival);

        if (is_null($departure)) {

            $departure = DateTime::createFromImmutable($arrival);
            $departure = $departure->modify('+' . rand(1, 10) . ' days')
                ->format(DateTimeImmutable::ATOM);
        }

        $departure = new DateTimeImmutable($departure);

        return new Booking(
            rand(0, 9999),
            UserMother::random(),
            RoomMother::random(),
            $arrival,
            $departure
        );
    }
}