<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Core\Entities\Player;

interface PlayerRepositoryInterface {
    public function createPlayer();
    public function getPlayerById(int $id);
    public function updatePlayerCreditsByEntity(Player $entity);
}

class PlayerRepository implements PlayerRepositoryInterface, RepositoryBaseInterface {
    public function tableName(): string {
        return "player";
    }

    public function createPlayer() {
        $table = DB::table($this->tableName());
        $userId = '';
        $retryCount = 0;

        do {
            // 重複チェックを10回まで行いそれでも生成できなかったらfalseにする
            if ($retryCount === 10) {
                return false;
            }
            $userId = (string)$this->generateSnowflakeId();
            $retryCount++;
            // 重複チェックを一度は行う
        } while($table->where('user_id', $userId)->first() != null);

        $time = date('Y-m-d H:i:s', time());

        $isOk = $table->insert([
            'user_id'=>$userId,
            'level'=>1,
            'exp'=>0,
            'money'=>0,
            'credits'=>500,
            'created_at'=>$time,
            'updated_at'=>$time
        ]);

        return $isOk;
    }

    public function getPlayerById(int $id){
        $res = DB::table($this->tableName())->where('user_id', $id)->first();
        if ($res !== null) {
            $entity = new Player(
                $res->user_id,
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
        ->where('user_id', $entity->id)
        ->update([
            'credits' => $entity->credits
        ]);
    }

    private function generateSnowflakeId() {
        $timestamp = (int)(microtime(true) * 1000);
        $machineId = rand(0, 255);
        $sequnce = rand(0, 255);
        $userId = (($timestamp -  1577836800000) << 16) | ($machineId << 8) | $sequnce;

        return $userId;
    }
}
