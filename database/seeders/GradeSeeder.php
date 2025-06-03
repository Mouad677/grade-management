<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\User;
use App\Models\Subject;

class GradeSeeder extends Seeder
{
    public function run()
    {
        // Récupérer tous les étudiants
        $students = User::where('role', 'student')->get();
        
        // Récupérer toutes les matières
        $subjects = Subject::all();

        // Pour chaque étudiant, créer quelques notes
        foreach ($students as $student) {
            foreach ($subjects as $subject) {
                // Créer 2-3 notes par matière pour chaque étudiant
                for ($i = 0; $i < rand(2, 3); $i++) {
                    Grade::create([
                        'student_id' => $student->id,
                        'subject_id' => $subject->id,
                        'grade' => rand(10, 20), // Note entre 10 et 20
                        'comment' => 'Note de test pour ' . $subject->name,
                    ]);
                }
            }
        }
    }
} 