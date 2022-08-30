<?php

namespace App\Helpers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostHelper
{
    private const COVER_PATH = 'public/posts/covers';

    public static function UploadCover($cover)
    {
        $coverName = $cover->hashName();
        $cover->storeAs(self::COVER_PATH, $coverName);

        return $coverName;
    }

    public static function UpdateCover($cover, $oldCoverName)
    {
        $newCover = self::UploadCover($cover);
        Storage::delete(self::COVER_PATH.'/'.$oldCoverName);

        return $newCover;
    }

    public static function generateSlug($value, $authId = null)
    {
        $slug = Str::slug($value);

        if ($authId) {
            if (Post::where('uri', $slug)->where('id', '!=', $authId)->exists()) {
                $newValue = self::setUniqueSlug($value);
                $slug = self::generateSlug($newValue, $authId);
            }

            return $slug;
        }

        if (Post::where('uri', $slug)->exists()){
            $newValue = self::setUniqueSlug($value);
            $slug = self::generateSlug($newValue);
        }
        
        return $slug;
    }

    private static function setUniqueSlug($value)
    {
        return $value.'-'.Str::random(5);
    }
}