<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Admin extends Model {
    public function check_user_id(Request $req) {
        $form = $req->all();
        if(!Util::is_form_full($form)) {
            return null;
        }

        $id = $form['id'];

        $userStatusRepo = new UserStatusRepo();
        $model = $userStatusRepo->read_by_id($id);
        if ($model === null) {
            return null;
        }

        // これをjsonで渡す？
        return null;
    }

    public function update_user_data(Request $req) {

    }
}