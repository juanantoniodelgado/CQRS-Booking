<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Infrastructure\Exception\InvalidParameterException;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use App\Domain\Model\Room\Room;

class RoomTest extends TestCase
{
    private $faker;

    public function setUp() : void
    {
        $this->faker = Factory::create();
    }

    /**
     * @test
     * @throws InvalidParameterException
     */
    public function testCreateValidRoom()
    {
        $id = $this->faker->numberBetween(1,1000);
        $name= $this->faker->name;

        $room = new Room ($id, $name);

        $this->assertSame($id, $room->getId());
        $this->assertTrue($room->getId() > 0);

        $this->assertSame($name, $room->getName());
        $this->assertNotEmpty($room->getName());
    }

    /**
     * @test
     */
    public function testCreateRoomInvalidId()
    {
        $id = $this->faker->numberBetween(-100,0);
        $name= $this->faker->name;

        $this->expectException(InvalidParameterException::class);
        new Room($id, $name);
    }

    /**
     * @test
     */
    public function testCreateRoomEmptyName()
    {
        $id = $this->faker->numberBetween(1,1000);
        $name= '';

        $this->expectException(InvalidParameterException::class);
        new Room($id, $name);
    }

    /**
     * @test
     */
    public function testCreateRoomNameTooLong()
    {
        $id = $this->faker->numberBetween(1,1000);
        $name = 'ThisIsAVeryLongWordPleaseFakerStartTreatingStrings.';

        $this->expectException(InvalidParameterException::class);
        new Room($id, $name);
    }
}