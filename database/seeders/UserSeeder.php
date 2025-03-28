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
        $user = (new \App\Models\User)->create([
            'name' => 'developer',
            'username' => 'developer',
            'email' => 'developer@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->addRole('developer');

        for ($i = 0; $i < 12; $i++) {
            $content = (new \App\Models\User)->create([
                'name' => 'sales-'.$i,
                'username' => 'sales-'.$i,
                'email' => $i.'-sales@gmail.com',
                'password' => bcrypt('password'),
            ]);
            $content->addRole('sales');
        }
    }
}
