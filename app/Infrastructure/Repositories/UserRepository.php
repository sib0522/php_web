<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Core\Entities\User;

interface UserRepositoryInterface {
    public function createUser(string $nickname, string $email, string $password) : bool;
    public function updateUser();
    public function getUserByEmail(string $email) : User;
}

class UserRepository implements UserRepositoryInterface, RepositoryBaseInterface {
    public function tableName(): string {
        return "user";
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

    public function getUserByEmail(string $email) : User{
        $res = DB::table($this->tableName())->where('email', $email)->first();
        if ($res !== null) {
            $entity = new User(
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