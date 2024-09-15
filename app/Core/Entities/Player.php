<?php

namespace App\Core\Entities;

final class Player {
    public readonly string $id; 
    public readonly int $level;
    public readonly int $exp;
    public readonly int $money;
    public readonly int $credits;

    public function __construct(string $id, int $level, int $exp, int $money, int $credits) 
    {
        $this->id = $id;
        $this->level = $level;
        $this->exp = $exp;
        $this->money = $money;
        $this->credits = $credits;
    }
}
