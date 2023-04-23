<?php

namespace App\Domain;

use JsonSerializable;

class User implements JsonSerializable
{
    private int $id;
    private string $email;

    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'email' => $this->email,
        );
    }
}

