<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //create roles and assign existing permissions
        $userRole = Role::create(['name' => 'contributor']);

        $adminRole = Role::create(['name' => 'admin']);

        $user = User::create([
            'name'      => 'Admin',
            'nip'       => '1',
            'password'  => Hash::make('password123')
        ]);

        $user->assignRole($adminRole);
        // $users = User::factory()->count(30)->create();
        // $users = factory(User::class, 10)->create();
        // foreach($users as $user){
        //     $user->assignRole($userRole);
        // }
    }
}
