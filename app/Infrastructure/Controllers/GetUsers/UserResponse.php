<?php

namespace App\Infrastructure\Controllers\GetUsers;

use App\Domain\User;
use JsonSerializable;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 **/
class UserResponse implements JsonSerializable
{
    private int $id;
    private string $email;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->email = $user->getEmail();
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email
        ];
    }
}
