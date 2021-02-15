<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Domain\Model\Room;
use App\Infrastructure\Exception\InvalidParameterException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RoomFixtures extends Fixture
{
    public const ROOM_REFERENCE = 'rooms';

    /**
     * @param ObjectManager $manager
     *
     * @throws InvalidParameterException
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $rooms = new ArrayCollection();

        for ($i=1; $i<=20; ++$i) {

            $room = new Room($i, $faker->name);
            //$manager->persist($room);
            $rooms->add($room);
        }

        //$manager->flush();
        $this->addReference(self::ROOM_REFERENCE, $rooms);
    }
}