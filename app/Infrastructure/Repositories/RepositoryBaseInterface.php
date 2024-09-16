<?php

namespace App\Infrastructure\Repositories;

interface RepositoryBaseInterface {
    public function tableName() : string;
}

class DBError {
    public static function insertErrorMessage(string $tableName) : string {
        return sprintf("db insert error : %s", $tableName);
    }
}
