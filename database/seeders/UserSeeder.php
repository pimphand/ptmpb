<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'email' => 'developer@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $developer->addRole('developer');

        $admin = (new \App\Models\User)->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $admin->addRole('admin');

        $content = (new \App\Models\User)->create([
            'name' => 'Content',
            'email' => 'content@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $content->addRole('content');
    }
}
