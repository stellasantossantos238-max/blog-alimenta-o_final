<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function create(User $user): bool
    {
        return $user->canPost();
    }

    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->canPost();
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }
}
