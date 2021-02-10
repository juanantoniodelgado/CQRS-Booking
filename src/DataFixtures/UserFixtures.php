<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Domain\Model\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'users';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $users = new ArrayCollection();

        for ($i=0; $i<=20; ++$i) {

            $user = new User($i, $faker->name);
            $manager->persist($user);
            $users->add($user);
        }

        $manager->flush();
        $this->addReference(self::USER_REFERENCE, $users);
    }
}