<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

abstract class Helper 
{
    protected static $imagePath;

    public static function UploadImage($cover)
    {
        $coverName = $cover->hashName();
        $cover->storeAs(static::$imagePath, $coverName);

        return $coverName;
    }

    public static function UpdateImage($cover, $oldCoverName)
    {
        $newCover = self::UploadImage($cover);
        self::deleteImage($oldCoverName);

        return $newCover;
    }

    public static function deleteImage($image)
    {
        if ($image) {
            Storage::delete(static::$imagePath.'/'.$image);
        }
    }
}