<?php

namespace App\Module\Post\Policies;

use App\Http\Permissions\PermissionList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PostPolicy.
 *
 * @package namespace App\Module\Post\Policies;
 */
class PostPolicy
{
   use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->hasPermissionTo(PermissionList::POST_MANAGE);
    }

    public function show(User $user): bool
    {
        return $user->hasPermissionTo(PermissionList::POST_MANAGE);
    }

    public function store(User $user): bool
    {
        return $user->hasPermissionTo(PermissionList::POST_EDIT);
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo(PermissionList::POST_EDIT);
    }

    public function destroy(User $user): bool
    {
        return $user->hasPermissionTo(PermissionList::POST_DELETE);
    }

    public function publish(User $user): bool
    {
        return $user->hasPermissionTo(PermissionList::POST_PUBLISH);
    }
}
