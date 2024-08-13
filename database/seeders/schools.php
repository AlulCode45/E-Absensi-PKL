<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class schools extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            ['name' => 'SMP Negeri 1', 'regency' => 'Kota Malan'],
            ['name' => 'SMP Negeri 2', 'regency' => 'Kota Malan'],
            ['name' => 'SMP Negeri 3', 'regency' => 'Kota Malan'],
            ['name' => 'SMP Negeri 4', 'regency' => 'Kota Malan'],
            ['name' => 'SMP Negeri 5', 'regency' => 'Kota Malan'],
            ['name' => 'SMP Negeri 6', 'regency' => 'Kota Malan'],
            ['name' => 'SMP Negeri 7', 'regency' => 'Kota Malan'],
            ['name' => 'SMP Negeri 8', 'regency' => 'Kota Malan'],
            ['name' => 'SMP Negeri 9', 'regency' => 'Kota Malan'],
            ['name' => 'SMP Negeri 10', 'regency' => 'Kota Malan'],
        ];

        foreach ($schools as $school) {
            \App\Models\SchoolsModel::create($school);
        }
    }
}