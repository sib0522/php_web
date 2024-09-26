<?php

namespace Master;

abstract class MasterBase {
    protected $datas;
    protected $typeInfo;

    public function __construct($master)
    {
        $this->getDatas($master);
    }

    public function validate($v) {
        if (!isset($v)) {
            echo "master is not initialized or broken";
            return null;
        }
        return $v;
    }

    public function getDatas($master) {
        $dir = base_path('master');
        $pa = $dir . '/' . $master . '.json';
        $file = glob($pa);
        $jsonString = file_get_contents($file[0]);

        $this->datas= json_decode($jsonString, true);

        return;
    }

    public function withType($key, $value) {
        $this->typeInfo = $this->datas[0];
        switch ($this->typeInfo[$key]) {
            case "string":
                return (string)$value;
            case "int":
                return (integer)$value;
            case "array(string)":
                return explode(',', $value);
            case "array(int)":
                return array_map('intval', explode(',', $value));
        }
    }
}