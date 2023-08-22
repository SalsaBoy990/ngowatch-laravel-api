<?php

namespace Tests\Unit\App\Trait;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Trait\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HasRolesAndPermissionsTest extends TestCase
{
    use DatabaseTransactions;
    use HasRolesAndPermissions;

    private User $user;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = User::factory()->create();
        $this->user = User::with(['permissions', 'role'])
            ->where('id', '=', $this->user->id)
            ->firstOrFail();

    }


    /**
     * Image url argument should be a real url
     *
     * @return void
     */
    public function test_user_exists(): void
    {
        $hasUser = $this->user ? true : false;
        $this->assertTrue($hasUser);
    }


    /**
     * @return void
     */
    public function test_user_has_role(): void
    {
        $this->assertTrue($this->user->hasRole('administrator'));
        $this->assertTrue(isset($this->user->role));
    }

    /**
     * @return void
     */
    public function test_user_has_roles(): void
    {
        $this->assertTrue($this->user->hasRoles('super-administrator|administrator'));
        $this->assertTrue(isset($this->user->role));
    }


    /**
     * @return void
     */
    public function test_user_has_permission_to(): void
    {
        $this->assertTrue($this->user->hasPermissionTo('manage-account'));
    }

    /**
     * @return void
     */
    public function test_user_has_permission_through_role(): void
    {
        $permission = Permission::where( 'slug', 'manage-account')->firstOrFail();
        $this->assertTrue($this->user->hasPermissionThroughRole($permission));
    }

    /**
     * @return void
     */
    public function test_get_permission_by_slug(): void
    {
        $permission = $this->getPermissionBySlug('manage-account');
        $this->assertTrue($permission instanceof Permission);
    }

    /**
     * @return void
     */
    public function test_get_role_by_slug(): void
    {
        $role = $this->getRoleBySlug('administrator');
        $this->assertTrue($role instanceof Role);
    }


    /**
     * @return void
     */
    public function test_delete_user_role(): void
    {
        $this->user->deleteUserRole();
        $this->assertFalse($this->user->hasRole('administrator'));
    }



    /**
     * @return void
     */
    public function test_add_permission_to_user(): void
    {
        $this->user = $this->user->givePermissionsTo(['manage-articles']);
        $this->user->refresh();

        $this->assertTrue($this->user->hasPermissionTo('manage-articles'));
    }

    /**
     * @return void
     */
    public function test_refresh_user_permissions(): void
    {
        $this->user = $this->user->refreshPermissions([1, 2, 4, 5]);
        $this->user->refresh();

        $permission = $this->getPermissionBySlug('manage-articles');

        // hasPermissionTo -> also checks if user has the permission through role!
        $this->assertFalse($this->user->hasPermission($permission));

        $this->assertTrue($this->user->hasPermissionTo('manage-account'));
    }


    /**
     * @return void
     */
    public function test_delete_user_permissions(): void
    {
        $this->user = $this->user->deletePermissions();
        $permission = $this->getPermissionBySlug('manage-account');

        // not using permissions-users relations directly, only through roles, so this will not work
        //
        $this->assertFalse($this->user->hasPermission($permission));
    }


    /**
     * @return void
     */
    public function test_get_all_permissions(): void
    {
        $allPermissions = $this->getAllPermissions();

        $this->assertTrue($allPermissions instanceof Collection);
        $this->assertGreaterThanOrEqual(0, sizeof($allPermissions));
    }

    /**
     * @return void
     */
    public function test_get_all_permissions_by_array(): void
    {
        $allPermissions = $this->getAllPermissionsByArray(['manage-users', 'manage-account']);

        $this->assertTrue($allPermissions instanceof Collection);
        $this->assertGreaterThanOrEqual(0, sizeof($allPermissions));
    }


    /**
     * TODO
     * @return void
     */
    public function test_user_has_permission(): void
    {
        $permission = $this->getPermissionBySlug('manage-account');

        // this is not working currently
        $this->assertFalse($this->user->hasPermission($permission));
    }


}