<?php

use Illuminate\Support\Facades\Storage;

class AWS {
    public function upload_multiple(array $files) {
        foreach($files as $file) {
            Storage::disk('s3')->put($file, file_get_contents($file));
        }
    }

    public function download_multiple(string $prefix) {
        
    }
}