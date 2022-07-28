<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewDrafts(User $authUser, User $user)
    {
        return $authUser->can('update', $user);
    }

    public function update(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }
}
