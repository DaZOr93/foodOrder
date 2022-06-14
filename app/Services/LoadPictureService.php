<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class LoadPictureService
{
    public function saveImage($file)
    {
        if ($file) {
            $upload_folder = 'public/image';
            $filename = date("YmdHis") . "-" . $file->getClientOriginalName(); // image.jpg
            Storage::putFileAs($upload_folder, $file, $filename);
            return $filename;
        }

    }
}
