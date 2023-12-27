<?php

use Illuminate\Support\Facades\DB;

class UserStatusRepo implements IRepository {
    public function table_name(): string{
        return "user_status";
    }

    public function create_by_model(UserStatusModel $model) {
        $query = "INSERT INTO ? (email, password, nickname, updated_at, created_at) VALUES (?, ?, ?, ?, ?)"
        . "ON DUPLICATE KEY UPDATE level = VALUES(level), exp = VALUES(exp), money = VALUES(money), updated_at = VALUES(updated_at);";

        $values = array($this->table_name(), $model->uuid(), $model->level(), $model->exp(), $model->money(), $model->updated_at(), $model->created_at());
        if (!DB::insert($query, $values)) {
            return DBError::db_error_insert($this->table_name());
        }
    }

    public function read_by_uuid(string $uuid) {
        $query = "SELECT * FROM ? WHERE uuid = ?";
        $values = array($this->table_name(), $uuid);
        $result = DB::select($query, $values);

        if ($result == false) {
            DBError::db_error_select($this->table_name());
        }

        $model = new UserStatusModel($result[0]['uuid'], $result[0]['level'], $result[0]['exp'], $result[0]['money'], $result[0]['updatedAt'], $result[0]['createdAt']);

        return $model;
    }

    public function read_by_id(int $id) {
        $query = "SELECT * FROM ? WHERE id = ?";
        $values = array($this->table_name(), $id);
        $result = DB::select($query, $values);

        if ($result == false) {
            DBError::db_error_select($this->table_name());
        }

        $model = new UserStatusModel($result[0]['uuid'], $result[0]['level'], $result[0]['exp'], $result[0]['money'], $result[0]['updatedAt'], $result[0]['createdAt']);

        return $model;
    }

    public function read_table() {
        $query = "SELECT * FROM ?";
        $values = array($this->table_name());
        $result = DB::select($query, $values);

        return !$result ? DBError::db_error_select($this->table_name()) : $result;
    }
}