<?php

namespace App\Policies;

use App\Models\CommentReply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentReplyPolicy
{
    use HandlesAuthorization;

    public function update(User $authUser, CommentReply $reply)
    {
        return $authUser->id === $reply->user->id;
    }

    public function delete(User $authUser, CommentReply $reply)
    {
        return $authUser->id === $reply->user->id;
    }
}
