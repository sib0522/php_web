<?php

namespace Master;

use App\Core\Entities\Master\Gacha;

final class GachaMaster extends MasterBase {
    public function __construct()
    {
        parent::__construct("GachaMaster");
    }

    public function getById(string $Id) {
        foreach ($this->datas as $data) {
            if ($data['Id'] === $Id) {
                return new Gacha
                (
                    $this->withType('Id', $data['Id']), 
                    $this->withType('GachaName', $data['GachaName']), 
                    $this->withType('TargetCardIds', $data['TargetCardIds']), 
                    $this->withType('PickupCardIds', $data['PickupCardIds'])
                );
            }
        }
        return null;
    }
}