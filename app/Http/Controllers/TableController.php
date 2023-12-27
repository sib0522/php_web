<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableController extends Controller {
    public function table_list() {
        return view("table_list");
    }

    public function table_detail() {
        return view("table_detail");
    }
}