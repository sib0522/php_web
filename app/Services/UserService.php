<?php

namespace App\Services;

use App\Core\UseCases\UserUsecaseInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserService {
    protected UserUsecaseInterface $usecase;

    public function __construct(UserUsecaseInterface $userUsecase)
    {
        $this->usecase = $userUsecase;
    }

    public function UserSingupService(Request $req) {
        $nickname = $req->input('name');
        $email = $req->input('email');
        $inputPassword = $req->input('inputPassword');
        $confirmPassword = $req->input('confirmPassword');


        $status = $this->usecase->UserSignupUsecase($nickname, $email, $inputPassword, $confirmPassword);
        return response()->json([
            'data' => null
        ], $status);
    }

    public function UserLogoutService(Request $req) {
        $status = $this->usecase->UserLogoutUsecase();
        return response()->json([
            'data' => null,
        ], $status);
    }

    public function UserLoginService(Request $req) {
        $email = $req->input('email');
        $password = $req->input('password');
        
        $res = $this->usecase->UserLoginUsecase($email, $password);
        if (gettype($res) === "string") {
            return response()->json([
                    'data' => $res,
                ], Response::HTTP_OK);
        }

        return response()->json([
            'data' => null,
        ], $res);
}

    public function Ping() {
        return "sss";
    }
}