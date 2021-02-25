<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\DataFixtures\BookingFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetAvailableRoomTest extends WebTestCase
{
    use FixturesTrait;
    /**
     * @test
     */
    public function getRoomsAvailable()
    {
        $this->loadFixtures([BookingFixtures::class]);
        self::ensureKernelShutdown();
        $client = static::createClient();

        $client->request('GET', '/rooms_available/2021-03-09/2021-03-10', []);

        $responseContent = $client->getResponse()->getContent();
        $json = json_decode($responseContent, true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotNull($json);
        $this->assertTrue(sizeof($json) > 0);
    }
}