<?php

namespace App\Infrastructure\Controllers\GetUsers;

class UsersResponseMapper
{
    /**
     * @return UserResponse[]
     */
    public function map(?array $users): array
    {
        $userListResponse = [];
        if (is_null($users)) {
            return $userListResponse;
        }

        foreach ($users as $user) {
            $userListResponse[] = new UserResponse($user);
        }

        return $userListResponse;
    }
}
