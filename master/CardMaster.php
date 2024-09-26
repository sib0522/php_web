<?php

namespace Master;

use App\Core\Entities\Master\Card;

final class CardMaster extends MasterBase {
    public function __construct()
    {
        parent::__construct("CardMaster");
    }

    public function getById(string $Id) {
        foreach ($this->datas as $data) {
            if ($data['Id'] == $Id) {
                return new Card
                (
                    $this->withType('Id', $data['Id']), 
                    $this->withType('CardName', $data['CardName']), 
                    $this->withType('ImageURL', $data['ImageURL']), 
                    $this->withType('Rarity', $data['Rarity'])
                );
            }
        }
        return null;
    }
}