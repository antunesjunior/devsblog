<?php

namespace App\Helpers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostHelper extends Helper
{
    protected static $imagePath = 'public/posts/covers';

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