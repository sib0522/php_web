<?php

namespace App\Core\Entities;

use AdminAccountModel;
use AdminAccountRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Util;

class User {
    public $id;
    public $nickname;
    public $email;
    public $password;
}

/*
class Account extends Model {
    public function sign_out(Request $req) {
        if (!$this->is_login()) {
            // ログインしていない
            return null;
        }

        $req->session()->forget('email');

        // ログアウト成功
        return null;
    }

    // ログインしている場合はemailを返し、していない場合はfalseを返す
    public function is_login() {
        $email = session()->get('email');
        return $email === null ? false : $email;
    }
}
    */