<?php

final class UserStatusModel {
    private int $id;
    private string $uuid;
    private int $level;
    private int $exp;
    private int $money;
    private DateTime $updatedAt;
    private DateTime $createdAt;

    public function __construct(string $uuid, int $level, int $exp, int $money, DateTime $updatedAt, DateTime $createdAt) 
    {
        $this->uuid = $uuid;
        $this->level = $level;
        $this->exp = $exp;
        $this->money = $money;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    public function id() {
        return $this->id;
    }

    public function uuid() {
        return $this->uuid;
    }

    public function level() {
        return $this->level;
    }

    public function exp() {
        return $this->exp;
    }

    public function money() {
        return $this->money;
    }

    public function updated_at() {
        return $this->updatedAt;
    }

    public function created_at() {
        return $this->createdAt;
    }
}
 