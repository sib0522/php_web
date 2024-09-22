<?php

namespace App\Services;

use App\Core\UseCases\AccountUsecaseInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountService {
    protected AccountUsecaseInterface $usecase;

    public function __construct(AccountUsecaseInterface $accountUsecase)
    {
        $this->usecase = $accountUsecase;
    }

    public function AccountSignupService(Request $req) {
        $nickname = $req->input('name');
        $email = $req->input('email');
        $inputPassword = $req->input('inputPassword');
        $confirmPassword = $req->input('confirmPassword');


        $status = $this->usecase->AccountSignupUsecase($nickname, $email, $inputPassword, $confirmPassword);
        return response()->json([
            'data' => null
        ], $status);
    }

    public function AccountLogoutService(Request $req) {
        $status = $this->usecase->AccountLogoutUsecase();
        return response()->json([
            'data' => null,
        ], $status);
    }

    public function AccountLoginService(Request $req) {
        $email = $req->input('email');
        $password = $req->input('password');
        
        $res = $this->usecase->AccountLoginUsecase($email, $password);
        if (gettype($res) === "string") {
            return response()->json([
                    'data' => $res,
                ], Response::HTTP_OK);
        }

        return response()->json([
            'data' => null,
        ], $res);
    }
}
