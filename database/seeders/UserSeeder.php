<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $developer = (new \App\Models\User)->create([
            'name' => 'Developer',
            'username' => 'developer',
            'email' => 'developer@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $developer->addRole('developer');

        $admin = (new \App\Models\User)->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $admin->addRole('admin');

        $content = (new \App\Models\User)->create([
            'name' => 'Content',
            'username' => 'content',
            'email' => 'content@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $content->addRole('content');

        $driver = (new \App\Models\User)->create([
            'name' => 'Driver',
            'username' => 'driver',
            'email' => 'driver@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $driver->addRole('driver');
    }
}
