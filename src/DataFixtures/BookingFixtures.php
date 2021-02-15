<?php

declare(strict_types=1);

namespace App\DataFixtures;

use \DateTime;
use \DateTimeImmutable;
use \Exception;
use App\Infrastructure\Exception\BookingAlreadyExists;
use App\Infrastructure\Exception\BookingNotAvailableException;
use App\Tests\Unit\Domain\RoomMother;
use App\Tests\Unit\Domain\UserMother;
use App\Application\Booking\AddBookingRequest;
use App\Application\Booking\AddBookingService;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class BookingFixtures Extends Fixture
{
    private AddBookingService $createBookingService;

    /**
     * BookingFixtures constructor.
     *
     * @param AddBookingService $createBookingService
     */
    public function __construct(AddBookingService $createBookingService)
    {
        $this->createBookingService = $createBookingService;
    }

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<10; ++$i) {

            $room = RoomMother::random();
            $user = UserMother::random();

            for ($k=0; $k<3; ++$k) {

                $arrival = new DateTime('now');
                $arrival = new DateTimeImmutable(
                    $arrival->modify('+' . $faker->numberBetween(1, 10) . ' days')->format(DateTimeImmutable::ATOM)
                );

                $departure = new DateTime($arrival->format(DateTimeImmutable::ATOM));
                $departure = new DateTimeImmutable(
                    $departure->modify('+' . $faker->numberBetween(1, 10) . ' days')->format(DateTimeImmutable::ATOM)
                );

                try {

                    $this->createBookingService->execute(
                        new AddBookingRequest(
                            $faker->numberBetween(1, 9999),
                            $user->getId(),
                            $user->getName(),
                            $room->getId(),
                            $room->getName(),
                            $arrival,
                            $departure
                        )
                    );

                } catch (BookingNotAvailableException | BookingAlreadyExists) {}
            }
        }
    }
}