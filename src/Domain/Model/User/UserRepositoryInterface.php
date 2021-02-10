<?php

declare(strict_types=1);

namespace App\Domain\Model\User;

use App\Domain\Model\BaseRepositoryInterface;
use App\Infrastructure\Exception\EntityNotFoundException;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $userId
     * @throws EntityNotFoundException
     * @return User
     */
    public function byId(int $userId): User;
}