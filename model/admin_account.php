<?php

final class AdminAccountModel {
    private int $id;
    private string $email;
    private string $password;
    private string $nickname;
    private DateTime $updatedAt;
    private DateTime $createdAt;

    public function __construct(string $email, string $password, string $nickname, DateTime $updatedAt, DateTime $createdAt) 
    {
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    public function id() {
        return $this->id;
    }

    public function email() {
        return $this->email;
    }

    public function password() {
        return $this->password;
    }

    public function nickname() {
        return $this->nickname;
    }

    public function updated_at() {
        return $this->updatedAt;
    }

    public function created_at() {
        return $this->createdAt;
    }
}
 