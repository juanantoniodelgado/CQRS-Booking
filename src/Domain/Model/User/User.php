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
    private $id;

    /**
     * @var string $nickname
     *
     * @ORM\Column(name="nickname", type="string", length=30)
     */
    private $nickname;
}