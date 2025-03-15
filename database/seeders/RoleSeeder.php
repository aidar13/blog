<?php

namespace Database\Seeders;

use App\Http\Permissions\PermissionList;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => PermissionList::POST_MANAGE]);
        Permission::create(['name' => PermissionList::POST_EDIT]);
        Permission::create(['name' => PermissionList::POST_PUBLISH]);
        Permission::create(['name' => PermissionList::POST_DELETE]);
        Permission::create(['name' => PermissionList::CATEGORY_MANAGE]);
        Permission::create(['name' => PermissionList::USER_MANAGE]);

        $adminRole  = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $authorRole = Role::create(['name' => 'author']);
        $viewerRole = Role::create(['name' => 'reader']);

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

        $viewerRole->givePermissionTo([
            PermissionList::POST_MANAGE,
            PermissionList::CATEGORY_MANAGE,
            PermissionList::USER_MANAGE
        ]);
    }
}
