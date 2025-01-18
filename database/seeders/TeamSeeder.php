<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'John Doe',
                'position' => 'CEO',
                'order' => 1,
                'team_name' => 'CEO',
            ],
            [
                'name' => 'Jane Doe',
                'position' => 'CTO',
                'order' => 2,
                'team_name' => 'CTO',
            ],
            [
                'name' => 'John Smith',
                'position' => 'COO',
                'order' => 3,
                'team_name' => 'COO',
            ],
            [
                'name' => 'Jane Smith',
                'position' => 'CFO',
                'order' => 4,
                'team_name' => 'CFO',
            ],
            [
                'name' => 'Jane Smith',
                'position' => 'CFO',
                'order' => 5,
                'team_name' => 'CFO',
            ],
        ];

        foreach ($teams as $team) {
            \App\Models\Team::create($team);
        }
    }
}
