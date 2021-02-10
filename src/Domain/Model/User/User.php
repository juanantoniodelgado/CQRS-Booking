<?php

declare(strict_types=1);

namespace App\Domain\Model\User;

use App\Domain\Model\AggregateRoot;

class User implements AggregateRoot
{
    private int $id;
    private string $nickname;

    /**
     * @param int $id
     * @param string $nickname
     */
    public function __construct(int $id, string $nickname)
    {
        $this->id = $id;
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