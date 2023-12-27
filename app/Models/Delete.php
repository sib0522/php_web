<?php

namespace App\Models;

use App\Models\CommonModel;
use Illuminate\Database\Eloquent\Model;

class Delete extends Model {
    public function delete() {
        $login = CommonModel::is_login();
        if (!$login->status) {
            // ログインしてない場合は弾く
        }
    }
}