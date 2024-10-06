<?php

namespace App\Services;

use App\Core\UseCases\PlayerUsecaseInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlayerService {
    protected PlayerUsecaseInterface $usecase;

    public function __construct(PlayerUsecaseInterface $playerUsecase)
    {
        $this->usecase = $playerUsecase;
    }

    public function PlayerCreateService(Request $req) {
        $isOk = $this->usecase->PlayerCreateUsecase();
        $status = !$isOk ? Response::HTTP_INTERNAL_SERVER_ERROR : Response::HTTP_OK;

        return response()->json([
            'data' => null
        ], $status);
    }
}
