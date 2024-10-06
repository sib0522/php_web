<?php

namespace App\Services;

use App\Core\UseCases\GachaUsecaseInterface;
use Illuminate\Http\Request;
use Illuminate\http\Response;

class GachaService {
    protected GachaUsecaseInterface $gachaUsecase;

    public function __construct(GachaUsecaseInterface $gachaUsecase)
    {
        $this->gachaUsecase = $gachaUsecase;
    }

    public function GachaService(Request $req) {
        $userId = $req->input('user_id');
        $resultCardId = null;
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($userId !== null) {
            $resultCardId = $this->gachaUsecase->GachaUsecase($userId);
            $status = $resultCardId === null ? Response::HTTP_INTERNAL_SERVER_ERROR : Response::HTTP_OK;
        }

        return response()->json([
            'id' => $userId,
            'result' => $resultCardId,
        ], $status);
    }
}