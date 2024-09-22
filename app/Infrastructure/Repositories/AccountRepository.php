<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Core\Entities\Account;
use App\Infrastructure\Repositories\RepositoryBaseInterface;

interface AccountRepositoryInterface {
    public function createAccount(string $nickname, string $email, string $password, string $time) : bool;
    public function updateAccount();
    public function getAccountByEmail(string $email);
}

class AccountRepository implements AccountRepositoryInterface, RepositoryBaseInterface {
    public function tableName(): string {
        return "account";
    }

    public function createAccount(string $nickname, string $email, string $password, string $time) : bool {
        $isOk = DB::table($this->tableName())->insert([
            'id'=>(string)Str::uuid(),
            'nickname'=>$nickname,
            'email'=>$email,
            'password'=>$password,
            'created_at'=>$time,
            'updated_at'=>$time
        ]);

        return $isOk;
    }

    public function updateAccount() {
        
    }

    public function getAccountByEmail(string $email) {
        $res = DB::table($this->tableName())->where('email', $email)->first();
        if ($res !== null) {
            $entity = new Account(
                $res->id,
                $res->nickname,
                $res->email,
                $res->password,
            );
            return $entity;
        }
        return null;
    }
}
