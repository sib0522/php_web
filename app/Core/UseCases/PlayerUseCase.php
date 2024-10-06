<?php

namespace App\Core\UseCases;

use App\Infrastructure\Repositories\PlayerRepositoryInterface;

interface PlayerUsecaseInterface {
    public function PlayerCreateUsecase();
}

class PlayerUsecase implements PlayerUsecaseInterface {
    private PlayerRepositoryInterface $repo;
    public function __construct(PlayerRepositoryInterface $playerRepo) {
        $this->repo = $playerRepo;
    }

    /**
     * プレイヤーを生成するUsecase
     */
    public function PlayerCreateUsecase(){        
        $isOk = $this->repo->createPlayer();
        return $isOk;
    }
}
