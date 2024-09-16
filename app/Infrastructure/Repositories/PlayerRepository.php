<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Core\Entities\Player;

interface PlayerRepositoryInterface {
    public function getPlayerById(int $id) : Player;
    public function updatePlayerCreditsByEntity(Player $entity);
}

class PlayerRepository implements PlayerRepositoryInterface, RepositoryBaseInterface {
    public function tableName(): string {
        return "player";
    }

    public function getPlayerById(int $id) : Player{
        $res = DB::table($this->tableName())->where('id', $id)->first();
        if ($res !== null) {
            $entity = new Player(
                $res->id,
                $res->level,
                $res->exp,
                $res->money,
                $res->credits
            );
            return $entity;
        }
        return null;
    }

    public function updatePlayerCreditsByEntity(Player $entity) {
        DB::table($this->tableName())
        ->where('id', $entity->id)
        ->update([
            'credits' => $entity->credits
        ]);
    }
}
