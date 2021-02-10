<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Model\User\User;
use App\Infrastructure\Exception\EntityNotFoundException;
use App\Infrastructure\Exception\WritingException;
use App\Infrastructure\Persistance\Doctrine\Repository\UserRepository;

class GetUserService
{
    private UserRepository $repository;
    private AddUserService $addUserService;

    /**
     * GetUserService constructor.
     *
     * @param UserRepository $repository
     * @param AddUserService $addUserService
     */
    public function __construct(UserRepository $repository, AddUserService $addUserService)
    {
        $this->repository = $repository;
        $this->addUserService = $addUserService;
    }

    /**
     * @param int $userId
     * @param string $nickName
     *
     * @return User
     *
     * @throws WritingException
     */
    public function execute(int $userId, string $nickName): User
    {
        try {
            $user = $this->repository->byId($userId);
        } catch (EntityNotFoundException) {
            $user = $this->addUserService->execute($userId, $nickName);
        }

        return $user;
    }
}