<?php

namespace App\Core\UseCases;

use App\Infrastructure\Repositories\PlayerCardRepositoryInterface;
use App\Infrastructure\Repositories\PlayerRepositoryInterface;
use Master\CardMaster;
use Master\GachaMaster;

interface GachaUsecaseInterface {
    public function GachaUsecase(int $playerId);
}

class GachaUsecase implements GachaUsecaseInterface {
    private PlayerRepositoryInterface $playerRepo;
    private PlayerCardRepositoryInterface $playerCardRepo;

    private const int GachaOneCredit = 100;
    private const float SSRRate = 0.2;
    private const float SRRate = 0.3;
    private const float RRate = 0.4;
    private const float PickupBonusRate = 0.5;

    public function __construct(PlayerRepositoryInterface $playerRepo, PlayerCardRepositoryInterface $playerCardRepo) {
        $this->playerRepo = $playerRepo;
        $this->playerCardRepo = $playerCardRepo;
    }

    public function GachaUsecase(int $playerId) {
        $player = $this->playerRepo->getPlayerById($playerId);
        if ($player->credits < $this::GachaOneCredit) {
            $cardId = $this->gacha();
            $isOk = $this->playerCardRepo->createPlayerCard($playerId, $cardId);

            if (!$isOk) {
                return null;
            }

            // creditsを使用
            $player->useCredits(100);
            $this->playerRepo->updatePlayerCreditsByEntity($player);

            // ガチャの結果(cardId)を返す
            return $cardId;
        }

        // ガチャを実行できなかった
        return null;
    }

    // ガチャを回して出たカードのidを返す(1回)
    private function gacha() : int {
        $gachaMaster = new GachaMaster();
        $gm = $gachaMaster->getById(1);

        $cardMaster = new CardMaster();

        $rate = floatval(random_int(0, 100) / 100.0);

        $resultCardId = 0;

        $getCardRarity = function($id) use (&$cardMaster) {
            return $cardMaster->getById($id)->Rarity;
        };

        $ssrCardList = array_filter($gm->TargetCardIds, function($id) use (&$getCardRarity) {
            return $getCardRarity($id) === 4;
        });

        $srCardList = array_filter($gm->TargetCardIds, function($id) use (&$getCardRarity) {
            return $getCardRarity($id) === 3;
        });

        $rCardList = array_filter($gm->TargetCardIds, function($id) use (&$getCardRarity) {
            return $getCardRarity($id) === 2;
        });

        $nCardList = array_filter($gm->TargetCardIds, function($id) use (&$getCardRarity) {
            return $getCardRarity($id) < 2;
        });

        if ($rate <= GachaUsecase::SSRRate) {
            $pickupRate = floatval(random_int(0, 100) / 100.0);
            if ($pickupRate <= GachaUsecase::PickupBonusRate) {
                $resultCardId = array_rand($gm->PickupCardIds);
            } else {
                $resultCardId = array_rand($ssrCardList);
            }
        } else if ($rate <= GachaUsecase::SRRate) {
            $resultCardId = array_rand($srCardList);
        } else if ($rate <= GachaUsecase::RRate) {
            $resultCardId = array_rand($rCardList);
        } else {
            $resultCardId = array_rand($nCardList);
        }

        return $resultCardId;
    }
}
