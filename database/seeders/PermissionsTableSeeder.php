<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'admin' // id 1
        ]);
        Permission::create([
            'name' => 'user' // id 2
        ]);
        Permission::create([
            'name' => 'admin|user' // id 3
        ]);
        

        $admin = Role::where('name', 'admin')->first();
        $admin->permissions()->attach([1, 3]);

        $user = Role::where('name', 'user')->first();
        $user->permissions()->attach([2, 3]);
    }
}
