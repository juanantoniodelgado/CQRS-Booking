<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\Model\Room;
use App\Infrastructure\Exception\InvalidParameterException;
use Faker\Factory;

final class RoomMother
{
    /**
     * @return Room
     *
     * @throws InvalidParameterException
     */
    public static function random(): Room
    {
        $faker = Factory::create();

        return new Room(
            $faker->numberBetween(1, 1000),
            $faker->name
        );
    }

    /**
     * @return array
     *
     * @throws InvalidParameterException
     */
    public static function randomArray(): array
    {
        $result = [];

        for ($i=0; $i<10; ++$i) {
            $result[] = self::random();
        }

        return $result;
    }
}