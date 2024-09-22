<?php

namespace App\Core\UseCases;

use App\Infrastructure\Repositories\AccountRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

interface AccountUsecaseInterface {
    public function AccountLoginUsecase(string $email, string $inputPassword);
    public function AccountLogoutUsecase();
    public function AccountSignupUsecase(string $nickname, string $email, string $inputPassword, string $confirmPassword);
}

class AccountUsecase implements AccountUsecaseInterface {
    private AccountRepositoryInterface $repo;
    public function __construct(AccountRepositoryInterface $accountRepo) {
        $this->repo = $accountRepo;
    }

    /**
     * ログインを行うUsecase
     */
    public function AccountLoginUsecase(string $email, string $inputPassword) {
        $model = $this->repo->getAccountByEmail($email);

        // アカウントが存在しない
        if ($model === null || $model->email === "") {
            return Response::HTTP_BAD_REQUEST;
        }

        // パスワードが一致しない
        if (bcrypt($inputPassword) !== $model->password) {
            return Response::HTTP_BAD_REQUEST;
        }

        // セッションにemailを保存
        Session::put('email', $email);

        // ログイン成功
        return $email;
    }

    /**
     * ログアウトを行うUsecase
     */
    public function AccountLogoutUsecase() {
        $status = Response::HTTP_BAD_REQUEST;

        $value = Session::get('email');

        if ($value !== null) {
            Session::forget('email');
            $status = Response::HTTP_OK;
        }

        return $status;
    }

    /**
     * 会員登録を行うUsecase
     */
    public function AccountSignupUsecase(string $nickname, string $email, string $inputPassword, string $confirmPassword){        
        // パスワードが一致しない
        if ($inputPassword !== $confirmPassword) {
            return Response::HTTP_BAD_REQUEST;
        }

        $hashedPassword = bcrypt($inputPassword);

        // アカウントが存在する
        $model = $this->repo->getAccountByEmail($email);
        if ($model !== null) {
            return Response::HTTP_BAD_REQUEST;
        }

        $time = date('Y-m-d H:i:s', time());

        $isOk = $this->repo->createAccount($nickname, $email, $hashedPassword, $time);
        return $isOk ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
