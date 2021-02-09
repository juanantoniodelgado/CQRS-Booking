<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use \DateTime;
use \DateTimeImmutable;
use \Exception;
use App\Domain\Model\Booking\Booking;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class BookingFixtures Extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        /** @var ArrayCollection $rooms */
        $rooms = $this->getReference(RoomFixtures::ROOM_REFERENCE);
        /** @var ArrayCollection $users */
        $users = $this->getReference(UserFixtures::USER_REFERENCE);

        for ($i=0; $i<20; ++$i) {

            $room = $rooms->get($i);
            $user = $users->get($i);

            for ($k=0; $k<5; ++$i) {

                $arrival = new DateTime('now');
                $arrival = new DateTimeImmutable(
                    $arrival->modify('+' . $faker->numberBetween(1, 10) . ' days')
                );

                $departure = new DateTime($arrival);
                $departure = new DateTimeImmutable(
                    $departure->modify('+' . $faker->numberBetween(1, 10) . ' days')
                );

                $manager->persist(new Booking($user, $room, $arrival, $departure));
            }
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies() : array
    {
        return [
            RoomFixtures::class,
            UserFixtures::class,
        ];
    }
}