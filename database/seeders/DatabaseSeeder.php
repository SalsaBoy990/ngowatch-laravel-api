<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Auth\PermissionSeeder;
use Database\Seeders\Auth\RoleSeeder;
use Database\Seeders\Auth\RolesPermissionsPivotSeeder;
use Database\Seeders\Auth\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class); // also seeds galleries, tags, goals
        $this->call(RolesPermissionsPivotSeeder::class);
        $this->call(ArticlesSeeder::class);

    }
}
