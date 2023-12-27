<?php

use Illuminate\Support\Facades\DB;

class AdminAccountRepo implements IRepository{
    public function table_name(): string {
        return "admin_account";
    }

    public function create_by_model(AdminAccountModel $model) {
        $query = "INSERT INTO ? (email, password, nickname, updated_at, created_at) VALUES (?, ?, ?, ?, ?)";
        $values = array("name" => $this->table_name(), $model->email(), $model->password(), $model->nickname(), $model->updated_at(), $model->created_at());
        if (!DB::insert($query, $values)) {
            return DBError::db_error_insert($this->table_name());
        }
    }

    public function read_by_email(string $email) {
        $query = "SELECT * FROM ? WHERE email = ?";
        $values = array($this->table_name(), $email);
        $result = DB::select($query, $values);

        if ($result == false) {
            return DBError::db_error_select($this->table_name());
        }

        $model = new AdminAccountModel($result[0]['id'], $result[0]['email'], $result[0]['password'], $result[0]['nickname'], $result[0]['updatedAt'], $result[0]['createdAt']);

        return $model;
    }

    public function read_by_id(int $id) {
        $query = "SELECT * FROM ? WHERE id = ?";
        $values = array($this->table_name(), $id);
        $result = DB::select($query, $values);

        if ($result == false) {
            DBError::db_error_select($this->table_name());
        }

        $model = new AdminAccountModel($result[0]['id'], $result[0]['email'], $result[0]['password'], $result[0]['nickname'], $result[0]['updatedAt'], $result[0]['createdAt']);

        return $model;
    }

    public function read_multiple_by_id(int $id) {
        $query = "SELECT * FROM ? WHERE id = ?";
        $values = array($this->table_name(), $id);
        $result = DB::select($query, $values);

        if ($result == false) {
            DBError::db_error_select($this->table_name());
        }

        $models = array();

        foreach($result as $row) {
            $model = new AdminAccountModel($row->id, $row->email, $row->password, $row->nickname, $row->updatedAt, $row->createdAt);
            array_push($models, $model);
        }

        return $models;
    }

    public function delete_by_model(AdminAccountModel $model) {
        $query = "DELETE FROM ? WHERE id = ? AND email = ?";
        $values = array($this->table_name(), $model->id(), $model->email());
        if (!DB::delete($query, $values)) {
            return DBError::db_error_delete($this->table_name());
        }
    }

    public function read_table() {
        $query = "SELECT * FROM ?";
        $values = array($this->table_name());
        $result = DB::select($query, $values);

        return !$result ? DBError::db_error_select($this->table_name()) : $result;
    }
}