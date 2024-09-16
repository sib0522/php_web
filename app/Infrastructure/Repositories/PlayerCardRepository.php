<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Core\Entities\Player;

interface PlayerCardRepositoryInterface {
    public function createPlayerCard(int $playerId, int $cardId);
}

class PlayerCardRepository implements PlayerCardRepositoryInterface, RepositoryBaseInterface {
    public function tableName(): string {
        return "player_card";
    }

    // playerIdとcardIdを紐づける 
    public function createPlayerCard(int $playerId, int $cardId) : bool {
        $time = time();

        $isOk = DB::table($this->tableName())->insert([
            'player_id'=>$playerId,
            'card_id'=>$cardId,
            'createdAt'=>$time
        ]);

        return $isOk;
    }
}
