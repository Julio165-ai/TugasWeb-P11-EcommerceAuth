<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function update(User $user, Post $post): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'editor' && $post->user_id === $user->id);
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }
}