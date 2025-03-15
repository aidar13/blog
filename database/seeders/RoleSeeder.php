<?php

namespace Database\Seeders;

use App\Http\Permissions\PermissionList;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionNames = [
            PermissionList::POST_MANAGE,
            PermissionList::POST_EDIT,
            PermissionList::POST_PUBLISH,
            PermissionList::POST_DELETE,
            PermissionList::CATEGORY_MANAGE,
            PermissionList::USER_MANAGE,
        ];

        foreach ($permissionNames as $permissionName) {
            Permission::findOrCreate($permissionName, 'api');
        }

        $adminRole  = Role::findOrCreate(Role::NAME_ADMIN, 'api');
        $editorRole = Role::findOrCreate(Role::NAME_EDITOR, 'api');
        $authorRole = Role::findOrCreate(Role::NAME_AUTHOR, 'api');
        $readerRole = Role::findOrCreate(Role::NAME_READER, 'api');

        $adminRole->givePermissionTo([
            PermissionList::POST_MANAGE,
            PermissionList::POST_EDIT,
            PermissionList::POST_PUBLISH,
            PermissionList::POST_DELETE,
            PermissionList::CATEGORY_MANAGE,
            PermissionList::USER_MANAGE
        ]);

        $editorRole->givePermissionTo([
            PermissionList::POST_EDIT,
            PermissionList::POST_PUBLISH,
            PermissionList::POST_DELETE,
            PermissionList::CATEGORY_MANAGE,
            PermissionList::USER_MANAGE
        ]);

        $authorRole->givePermissionTo([
            PermissionList::POST_EDIT,
            PermissionList::POST_PUBLISH,
        ]);

        $readerRole->givePermissionTo([
            PermissionList::POST_MANAGE,
            PermissionList::CATEGORY_MANAGE,
            PermissionList::USER_MANAGE
        ]);
    }
}
