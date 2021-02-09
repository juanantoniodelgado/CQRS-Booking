<?php

declare(strict_types=1);

namespace App\Domain\Model\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Domain\Model\User
 *
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @var int $id
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var string $nickname
     *
     * @ORM\Column(name="nickname", type="string", length=30)
     */
    private string $nickname;

    /**
     * User constructor.
     * @param string $nickname
     */
    public function __construct(string $nickname)
    {
        $this->nickname = $nickname;
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
    public function getNickname(): string
    {
        return $this->nickname;
    }
}