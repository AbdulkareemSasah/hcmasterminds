<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $role = Role::create(['guard_name' => 'web', 'name' => 'Super User']);
        $role->permissions()->attach(Permission::all());
        $user = User::create([
            'name' => 'name',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role);
        // User::factory(10)->create();
        Language::create([

            'label' => 'العربية',
            'language' => 'ar',
            'default' => true,
            'active' => true,
        ]);
        Language::create(
            [
                'label' => 'English',
                'language' => 'en',
                'default' => false,
                'active' => true,
            ]
        );

        // Create a manager role for users authenticating with the admin guard:

        // Define a `publish articles` permission for the admin users belonging to the admin 


    }
}
