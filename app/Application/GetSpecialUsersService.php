<?php

namespace App\Application;

use App\Domain\User;
use App\Domain\UserRepository;

class GetSpecialUsersService
{
    private UserRepository $userDataSource;

    public function __construct(UserRepository $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @return User[]
     */
    public function execute(): array
    {
        $users = $this->userDataSource->getAll();

        return array_filter($users, function($user) {
            return ($user->getId() % 2 == 0 || $user->getId() % 5 == 0);
        });
    }
}
