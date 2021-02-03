<?php

declare(strict_types=1);

namespace App\Domain\Model\Room;

use App\Infrastructure\Exception\InvalidParameterException;
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
    const MAX_NAME_LENGTH = 50;

    /**
     * @var int $id
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="nombre", length=50, type="string")
     */
    private string $name;

    /**
     * Room constructor.
     *
     * @param int $id
     * @param string $name
     *
     * @throws InvalidParameterException
     */
    public function __construct(int $id, string $name)
    {
        $this->setId($id);
        $this->setName($name);
    }

    /**
     * @param $id
     * @throws InvalidParameterException
     */
    public function setId(int $id)
    {
        if($id <= 0) {
            throw new InvalidParameterException("Id must be integer and > 0");
        }

        $this->id = $id;
    }

    /**
     * @param $name
     * @throws InvalidParameterException
     */
    public function setName($name)
    {
        if (empty($name) || strlen($name) > self::MAX_NAME_LENGTH) {
            throw new InvalidParameterException('Invalid provided name');
        }

        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}