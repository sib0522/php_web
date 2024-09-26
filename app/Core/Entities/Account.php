<?php

namespace App\Core\Entities;

final class Account {
    private string $id;
    private string $nickname;
    private string $email;
    private string $password;

    public function __construct(string $id, $nickname, $email, $password)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
    }
}
