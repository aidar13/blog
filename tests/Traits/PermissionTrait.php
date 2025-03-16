<?php

namespace Tests\Traits;

use App\Models\User;
use Spatie\Permission\Contracts\Permission as SpatiePermission;
use Spatie\Permission\Models\Permission;

trait PermissionTrait
{
    private function givePermissionToUser(User $user, string $name, string $guardName = null): SpatiePermission
    {
        $permission = Permission::findOrCreate($name, $guardName);
        $user->givePermissionTo($permission);

        return $permission;
    }
}
