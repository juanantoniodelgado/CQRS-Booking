<?php

declare(strict_types=1);

namespace App\Domain\Model\Room;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Room
 * @package App\Domain\Model\Room
 *
 * @ORM\Entity()
 * @ORM\Table(name="room")
 */
class Room
{
    /**
     * @var int $id
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="nombre", length=50, type="string")
     */
    private $name;
}