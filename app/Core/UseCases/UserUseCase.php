<?php

namespace App\Core\UseCases;

use App\Infrastructure\Repositories\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

interface UserUsecaseInterface {
    public function UserLoginUsecase(string $email, string $inputPassword);
    public function UserLogoutUsecase();
    public function UserSignupUsecase(string $nickname, string $email, string $inputPassword, string $confirmPassword);
}

class UserUsecase implements UserUsecaseInterface {
    private UserRepositoryInterface $repo;

    public function __construct(UserRepositoryInterface $userRepo) {
        $this->repo = $userRepo;
    }

    /**
     * ログインを行うUsecase
     */
    public function UserLoginUsecase(string $email, string $inputPassword) {
        $model = $this->repo->getUserByEmail($email);

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
    public function UserLogoutUsecase() {
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
    public function UserSignupUsecase(string $nickname, string $email, string $inputPassword, string $confirmPassword){        
        // パスワードが一致しない
        if ($inputPassword !== $confirmPassword) {
            return Response::HTTP_BAD_REQUEST;
        }

        $hashedPassword = bcrypt($inputPassword);

        // アカウントが存在する
        $model = $this->repo->getUserByEmail($email);
        if ($model !== null) {
            return Response::HTTP_BAD_REQUEST;
        }

        $time = now();

        $isOk = $this->repo->createUser($nickname, $email, $hashedPassword, $time);
        return $isOk ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
