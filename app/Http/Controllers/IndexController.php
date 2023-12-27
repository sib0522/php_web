<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use Illuminate\Http\Request;

class IndexController extends Controller {
    public function index() {
        return view("index", CommonModel::get_instance());
    }
}