<?php

namespace App\Core\Entities\Master;

final class Card {
    public readonly string $Id;
    public readonly string $CardName;
    public readonly string $ImageURL;
    public readonly int $Rarity;

    public function __construct(string $id, string $cardName, string $imageUrl, int $rarity)
    {
        $this->Id = $id;
        $this->CardName = $cardName;
        $this->ImageURL = $imageUrl;
        $this->Rarity = $rarity;
    }
}