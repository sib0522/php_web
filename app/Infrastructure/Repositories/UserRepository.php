<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class userModel {
    public readonly string $email;
    public readonly string $password;
    public readonly string $nickname;
    public readonly int $updatedAt;
    public readonly int $createdAt;

    public function __construct(string $email, string $password, string $nickname, int $updatedAt, int $createdAt) 
    {
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }
}

interface UserRepositoryInterface {
    public function createUser(string $nickname, string $email, string $password) : bool;
    public function updateUser();
    public function getUserByEmail(string $email) : userModel;
}

class UserRepository implements UserRepositoryInterface, RepositoryBaseInterface {
    public function tableName(): string {
        return "admin_account";
    }

    public function createUser(string $nickname, string $email, string $password) : bool {
        $time = time();

        $isOk = DB::table($this->tableName())->insert([
            'id'=>(string)Str::uuid(),
            'nickname'=>$nickname,
            'email'=>$email,
            'password'=>$password,
            'updatedAt'=>$time,
            'createdAt'=>$time
        ]);

        return $isOk;
    }

    public function updateUser() {
        
    }

    public function getUserByEmail(string $email) : userModel{
        $res = DB::table($this->tableName())->where('email', $email)->first();
        if ($res !== null) {
            $model = new userModel(
                $res->email,
                $res->password,
                $res->nickname,
                $res->updatedAt,
                $res->createdAt
            );
            return $model;
        }
    }
}