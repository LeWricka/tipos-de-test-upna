<?php

namespace App\Infrastructure\Controllers\GetSpecialUsers;

class SpecialUsersResponseMapper
{
    /**
     * @return SpecialUserResponse[]
     */
    public function map(?array $users): array
    {
        $userListResponse = [];
        if (is_null($users)) {
            return $userListResponse;
        }

        foreach ($users as $user) {
            $userListResponse[] = new SpecialUserResponse($user);
        }

        return $userListResponse;
    }
}
