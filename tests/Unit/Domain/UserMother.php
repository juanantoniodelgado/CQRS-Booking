<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\Model\User;
use Faker\Factory;

final class UserMother
{
    public static function random(): User
    {
        $faker = Factory::create();

        return new User(
            $faker->numberBetween(1, 1000),
            $faker->name
        );
    }
}