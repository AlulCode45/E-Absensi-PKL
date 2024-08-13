<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class devision extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devision = [
            ['name' => 'Design'],
            ['name' => 'Programming'],
            ['name' => 'Networking'],
            ['name' => 'Multimedia'],
            ['name' => 'Database'],
            ['name' => 'Security'],
            ['name' => 'Hardware'],
            ['name' => 'Software'],
            ['name' => 'Mobile'],
            ['name' => 'Web'],
        ];

        foreach ($devision as $devision) {
            \App\Models\DevisionModel::create($devision);
        }
    }
}