<?php

namespace App\Utilities;

class Utilities {
    public static function is_form_full(array $array) : bool {
        foreach($array as $val) {
            if ($val == null || $val == "") return false;
        }
        return true;
    }
}
