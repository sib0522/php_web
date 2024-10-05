<?php

namespace App\Core\Entities;

final class Account {
    public readonly string $id;
    public readonly string $nickname;
    public readonly string $email;
    public readonly string $password;

    public function __construct(string $id, $nickname, $email, $password)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
    }
}
