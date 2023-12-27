<?php

namespace App\Models;

use illuminate\database\Eloquent\Factories\HasFactory;
use illuminate\database\Eloquent\Model;

class CommonModel extends Model {
    use HasFactory;
    
    private static $instance;

    // インスタンスを作成できないようにするためにコンストラクタを private にする
    private function __construct() {
        return;
    }

    public static function get_instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static string $loginEmail;

    public static function is_login(): \stdClass {
        $result = new \stdClass();

        if (self::$loginEmail == "") {
            $result->status = false;
            $result->email = "";
        } else {
            $result->status = true;
            $result->email = self::$loginEmail;
        }

        return $result;
    }
}