<?php

class DBError {
    public static function db_error_insert(string $tableName) {
        return new Error("INSERT failed : " . $tableName, 500);
    }

    public static function db_error_update(string $tableName) {
        return new Error("UPDATE failed : " . $tableName, 500);
    }

    public static function db_error_select(string $tableName) {
        return new Error("SELECT failed : " . $tableName, 500);
    }

    public static function db_error_delete(string $tableName) {
        return new Error("DELETE failed : " . $tableName, 500);
    }
}