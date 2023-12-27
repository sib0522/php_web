<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller {
    public function resource() {
        return view("resource");
    }

    public function gallery() {
        return view("gallery");
    }
}