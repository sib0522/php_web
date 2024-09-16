<?php

namespace App\Core\Entities\Master;

final class Card {
    public readonly int $Id;
    public readonly string $CardName;
    public readonly string $ImageURL;
    public readonly int $Rarity;

    public function __construct(int $id, string $cardName, string $imageUrl, int $rarity)
    {
        $this->Id = $id;
        $this->CardName = $cardName;
        $this->ImageURL = $imageUrl;
        $this->Rarity = $rarity;
    }
}