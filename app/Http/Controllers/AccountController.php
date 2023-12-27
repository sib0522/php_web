<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use Illuminate\Http\Request;

class AccountController extends Controller {
    public function register() {
        return view("register", CommonModel::get_instance());
    }

    public function login() {
        return view("login");
    }

    public function delete_view() {
        return view("delete");
    }

    public function delete(Request $req) {
        
    }
}