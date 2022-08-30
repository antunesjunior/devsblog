<?php

namespace App\Helpers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostHelper
{
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

    public static function UploadCover($cover)
    {
        $coverName = $cover->hashName();
        $coverPath = 'public/posts/covers';
        $cover->storeAs($coverPath, $coverName);

        return $coverName;
    }
}