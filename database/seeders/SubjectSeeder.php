<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects = [
            ['name' => 'Mathématiques', 'description' => 'Cours de mathématiques'],
            ['name' => 'Français', 'description' => 'Cours de français'],
            ['name' => 'Anglais', 'description' => 'Cours d\'anglais'],
            ['name' => 'Histoire', 'description' => 'Cours d\'histoire'],
            ['name' => 'Géographie', 'description' => 'Cours de géographie'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
} 