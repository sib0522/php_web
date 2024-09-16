<?php

namespace App\Services;

use App\Core\UseCases\GachaUsecaseInterface;
use Illuminate\Http\Request;

class GachaService {
    protected GachaUsecaseInterface $gachaUsecase;

    public function __construct(GachaUsecaseInterface $gachaUsecase)
    {
        $this->gachaUsecase = $gachaUsecase;
    }

    public function GachaService(Request $req) {
        $playerId = $req->input('id');

        $cardId = $this->gachaUsecase->GachaUsecase($playerId);

        return response()->json([
            'id' => $playerId,
            'result' => $cardId
        ], 500);
    }
}