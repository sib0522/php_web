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
        $userId = $req->input('user_id');
        $resultCardId = null;
        $status = 500;

        if ($userId !== null) {
            $resultCardId = $this->gachaUsecase->GachaUsecase($userId);
            $status = $resultCardId === null ? 400 : 200;
        }

        return response()->json([
            'id' => $userId,
            'result' => $resultCardId
        ], $status);
    }
}