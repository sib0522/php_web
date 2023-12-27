<?php

use MessagePack\MessagePack;

// 星をかけるPHP..
class Pluto {
    public static function pack($value) {
        $packed = MessagePack::pack($value);
        return $packed;
    }

    public static function unpack($packed) {
        $value = MessagePack::unpack($packed);
        return $value;
    }
}