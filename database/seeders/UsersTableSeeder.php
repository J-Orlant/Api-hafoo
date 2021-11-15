<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'username' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('thisisadmin'),
            'role_id' => 1
        ]);
        User::create([
            'name' => 'user',
            'username' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('thisisuser'),
            'role_id' => 2
        ]);
    }
}
