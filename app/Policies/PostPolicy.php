<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $authUser, Post $post)
    {
        return $authUser->id === $post->user->id;
    }

    public function delete(User $authUser, Post $post)
    {
        return $authUser->id === $post->user->id;
    }
}
