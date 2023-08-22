<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUsers = new Permission();
        $manageUsers->name = 'Manage users';
        $manageUsers->slug = 'manage-users';
        $manageUsers->save();

        $manageAccount = new Permission();
        $manageAccount->name = 'Manage Account';
        $manageAccount->slug = 'manage-account';
        $manageAccount->save();

        $manageEvents = new Permission();
        $manageEvents->name = 'Manage Articles';
        $manageEvents->slug = 'manage-articles';
        $manageEvents->save();

        $manageRoles = new Permission();
        $manageRoles->name = 'Manage Roles';
        $manageRoles->slug = 'manage-roles';
        $manageRoles->save();

        $managePermissions = new Permission();
        $managePermissions->name = 'Manage Permissions';
        $managePermissions->slug = 'manage-permissions';
        $managePermissions->save();

    }
}
