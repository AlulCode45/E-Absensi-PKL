<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class student extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'Ahmad Surya', 'nisn' => '1234567891', 'school_id' => 1, 'devisi_id' => 1],
            ['name' => 'Budi Santoso', 'nisn' => '1234567892', 'school_id' => 2, 'devisi_id' => 2],
            ['name' => 'Citra Ayu', 'nisn' => '1234567893', 'school_id' => 3, 'devisi_id' => 3],
            ['name' => 'Dewi Lestari', 'nisn' => '1234567894', 'school_id' => 4, 'devisi_id' => 4],
            ['name' => 'Eka Pratama', 'nisn' => '1234567895', 'school_id' => 5, 'devisi_id' => 5],
            ['name' => 'Fajar Nugroho', 'nisn' => '1234567896', 'school_id' => 6, 'devisi_id' => 6],
            ['name' => 'Gita Puspita', 'nisn' => '1234567897', 'school_id' => 7, 'devisi_id' => 7],
            ['name' => 'Hendra Wijaya', 'nisn' => '1234567898', 'school_id' => 8, 'devisi_id' => 8],
            ['name' => 'Indah Permata', 'nisn' => '1234567899', 'school_id' => 9, 'devisi_id' => 9],
            ['name' => 'Joko Widodo', 'nisn' => '1234567800', 'school_id' => 10, 'devisi_id' => 10],
        ];

        foreach ($students as $student) {
            \App\Models\StudentsModel::create($student);
        }

    }
}