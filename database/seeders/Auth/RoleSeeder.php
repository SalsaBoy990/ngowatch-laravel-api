<?php

namespace Database\Seeders\Auth;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'Super administrator';
        $admin->slug = 'super-administrator';
        $admin->save();

        $admin2 = new Role();
        $admin2->name = 'Administrator';
        $admin2->slug = 'administrator';
        $admin2->save();

        $customer = new Role();
        $customer->name = 'Customer';
        $customer->slug = 'customer';
        $customer->save();

    }
}
