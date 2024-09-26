<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;

interface PlayerCardRepositoryInterface {
    public function createPlayerCard(int $userId, int $cardId);
}

class PlayerCardRepository implements PlayerCardRepositoryInterface, RepositoryBaseInterface {
    public function tableName(): string {
        return "player_card";
    }

    // playerIdとcardIdを紐づける 
    public function createPlayerCard(int $userId, int $cardId) : bool {
        $time = date('Y-m-d H:i:s', time());

        $isOk = DB::table($this->tableName())->insert([
            'user_id'=>$userId,
            'card_id'=>$cardId,
            'created_at'=>$time
        ]);

        return $isOk;
    }
}
