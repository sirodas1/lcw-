<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

trait UploadTrait
{
    public function uploadOne($file, $folder = null, $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);
        $file = $file->storeOnCloudinaryAs($folder, $name)->getPath();
        return $file;
    }

    public function deleteOne($file)
    {
        return Cloudinary::destroy($file,['invalidate'=>true]);
    }
}
