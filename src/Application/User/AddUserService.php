<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Model\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Exception\WritingException;

class AddUserService
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId
     * @param string $nickname
     *
     * @return User
     *
     * @throws WritingException
     */
    public function execute(int $userId, string $nickname): User
    {
        $user = new User($userId, $nickname);

        $this->repository->save($user);

        return $user;
    }
}
