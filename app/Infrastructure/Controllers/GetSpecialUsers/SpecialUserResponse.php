<?php

namespace App\Infrastructure\Controllers\GetSpecialUsers;

use App\Domain\User;
use JsonSerializable;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 **/
class SpecialUserResponse implements JsonSerializable
{
    private int $id;
    private string $email;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->email = $user->getEmail();
    }

    /**
     * @return SpecialUserResponse[]
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email
        ];
    }
}
