<?php

namespace App\Models;

use AdminAccountModel;
use AdminAccountRepo;
use App\Models\CommonModel;
use Error;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;
use Util;

class Account extends Model {
    public function sign_up(Request $req) {
        $form = $req->all();
        if (!Util::is_form_full($form)) {
            // formDataが不完全な場合はreturn
            return null;
        }

        $nickname = $form['name'];
        $email = $form['email'];
        $inputPassword = $form['password'];
        $confirmPassword = $form['password2'];

        if ($inputPassword !== $confirmPassword) {
            // パスワードが一致しない
            return null;
        }

        $hashedPassword = bcrypt($inputPassword);

        $adminAccountRepo = new AdminAccountRepo();
        $model = $adminAccountRepo->read_by_email($email);
        if ($model !== null || $model->id() === 0) {
            // 既に存在しているemail
            return null;
        }

        $time = now();
        $newAdminAccount = new AdminAccountModel($email, $hashedPassword, $nickname, $time, $time);
        $adminAccountRepo->create_by_model($newAdminAccount);

        // アカウント生成成功
        return null;
    }

    public function sign_in(Request $req) {
        $form = $req->all();
        if (!Util::is_form_full($form)) {
            return null;
        }

        $email = $form['email'];
        $password = $form['password'];

        $adminAccountRepo = new AdminAccountRepo();
        $model = $adminAccountRepo->read_by_email($email);
        if ($model === null || $model->email() === "") {
            // アカウントが存在しない
            return null;
        }

        if (bcrypt($password) !== $model->password()) {
            // パスワードが一致しない
            return null;
        }

        // セッションにemailを保存
        $req->session(['email' => $email]);

        // ログイン成功
        return null;
    }

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