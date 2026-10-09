<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Product $product): bool
    {
        return true;
    }

    // Hanya admin dan editor yang boleh membuat produk
    public function create(User $user): bool
    {
        return $user->hasRole('admin', 'editor');
    }

    // Admin boleh edit semua; editor hanya produk miliknya sendiri
    public function update(User $user, Product $product): bool
    {
        return $user->hasRole('admin')
            || ($user->hasRole('editor') && $product->user_id === $user->id);
    }

    // Hanya admin yang boleh menghapus
    public function delete(User $user, Product $product): bool
    {
        return $user->hasRole('admin');
    }
}
