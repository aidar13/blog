<?php

declare(strict_types=1);

namespace App\Http\Permissions;

final class PermissionList
{
    const POST_MANAGE     = 'manage_posts';
    const POST_PUBLISH    = 'publish_posts';
    const POST_EDIT       = 'edit_posts';
    const POST_DELETE     = 'delete_posts';
    const CATEGORY_MANAGE = 'manage_categories';
    const USER_MANAGE      = 'manage_users';
}
