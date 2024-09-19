<?php

namespace Master;

abstract class MasterBase {
    protected $datas;

    public function __construct()
    {
        $this->getDatas('GachaMaster');
    }

    public function validate($v) {
        if (!isset($v)) {
            echo "master is not initialized or broken";
            return null;
        }
        return $v;
    }

    public function getDatas($master) {
        $dir = base_path('.');
        $file = glob($dir . '/' . $master . '.json');
        $jsonString = file_get_contents($file);
        return $this->datas = json_decode($jsonString, true);
    }
}