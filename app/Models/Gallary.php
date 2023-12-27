<?php

namespace App\Models;

use AdminAccountModel;
use AdminAccountRepo;
use App\Models\CommonModel;
use Error;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;
use Util;

class Gallary extends Model {
    const GALLERY_DIR = "./web/public/images";
    public function create_gallery(Request $req) {
        if (is_dir(self::GALLERY_DIR))
        mkdir(
            directory:self::GALLERY_DIR,
        );
    }
}