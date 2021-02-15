<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\User;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\WritingException;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @throws EntityNotFoundException
     *
     * @return User
     */
    public function byId(int $userId): User;

    /**
     * @param User $user
     *
     * @return void
     *
     * @throws WritingException
     */
    public function save(User $user): void;
}
