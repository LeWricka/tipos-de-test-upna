<?php

namespace App\Application;

use App\Application\Exceptions\UserNotFoundException;
use App\Domain\UserRepository;

class IsEarlyAdopterService
{
    private UserRepository $userDataSource;

    public function __construct(UserRepository $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @throws UserNotFoundException
     */
    public function execute(string $email): bool
    {
        $user = $this->userDataSource->findByEmail($email);
        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $user->getId() < 1000;
    }
}
