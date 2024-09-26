<?php

namespace App\Core\Entities;

final class Player {
    private string $id; 
    private int $level;
    private int $exp;
    private int $money;
    private int $credits;

    public function __construct(string $id, int $level, int $exp, int $money, int $credits) 
    {
        $this->id = $id;
        $this->level = $level;
        $this->exp = $exp;
        $this->money = $money;
        $this->credits = $credits;
    }

    public function useCredits(int $use) {
        $this->credits -= $use;
    }

    public function addCredits(int $add) {
        $this->credits += $add;
    }
}
