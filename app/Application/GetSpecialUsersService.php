<?php

namespace App\Application;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class GetSpecialUsersService
{
    private UserDataSource $userDataSource;

    public function __construct(UserDataSource $userDataSource)
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
