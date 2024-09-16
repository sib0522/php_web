<?php

namespace App\Core\Entities\Master;

final class Gacha {
    public readonly int $Id;
    public readonly string $GachaName;
    public readonly array $TargetCardIds;
    public readonly array $PickupCardIds;

    public function __construct(int $id, string $gachaName, array $targetCardIds, array $pickupCardIds)
    {
        $this->Id = $id;
        $this->GachaName = $gachaName;
        $this->TargetCardIds = $targetCardIds;
        $this->PickupCardIds = $pickupCardIds;
    }
}