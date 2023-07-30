<?php

namespace Modules\Consumer\Policies;

use App\Models\User;
use Modules\Consumer\Models\Consumer;

class ConsumerPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Consumer $guest): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Consumer $guest): bool
    {
        return false;
    }

    public function delete(User $user, Consumer $guest): bool
    {
        return false;
    }

    public function restore(User $user, Consumer $guest): bool
    {
        return false;
    }

    public function forceDelete(User $user, Consumer $guest): bool
    {
        return false;
    }
}
