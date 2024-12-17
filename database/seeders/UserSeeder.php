<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the admin user
        $adminUser = User::factory()->create([
            'name' => 'intriga',
            'email' => 'admin@demo.com',
            'password' => bcrypt('123456'),
        ]);

        // Create a new role
        $role = Role::create(['name' => 'admin']);

        // Create a new permission
        $permission = Permission::create(['name' => 'All']);

        // Assign permission to role
        $role->givePermissionTo($permission);

        // Assign role to the admin user
        $adminUser->assignRole('admin');

        // Create additional users
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@demo.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
