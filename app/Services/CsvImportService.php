<?php

namespace App\Services;

use App\Models\User;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CsvImportService
{
    protected $requiredColumns = [
        'level',
        'module_code',
        'module_name',
        'Coef_Ct',
        'Coef_Ex',
        'student_code',
        'last_name',
        'first_name',
        'note_ct',
        'note_ex',
        'note_element',
        'professor_name'
    ];

    public function import($filePath)
    {
        $handle = fopen(storage_path('app/public/' . $filePath), 'r');
        $header = fgetcsv($handle);
        
        // Vérifier les colonnes requises
        $missingColumns = array_diff($this->requiredColumns, $header);
        if (!empty($missingColumns)) {
            throw new \Exception('Colonnes manquantes dans le fichier CSV : ' . implode(', ', $missingColumns));
        }

        $grades = [];
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);
            
            // Créer ou mettre à jour l'étudiant
            $user = User::firstOrNew(['email' => $data['student_code'] . '@supmti.com']);
            if (!$user->exists) {
                $user->fill([
                    'name' => $data['first_name'] . ' ' . $data['last_name'],
                    'password' => Hash::make($data['student_code']),
                    'role' => 'student',
                    'student_code' => $data['student_code'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'level' => $data['level']
                ])->save();
                
                Log::info('Nouvel étudiant créé', ['student_code' => $data['student_code']]);
            }

            // Créer ou récupérer la matière
            $subject = Subject::firstOrCreate(
                ['name' => $data['module_name']],
                [
                    'description' => 'Module ' . $data['module_code'] . ' - ' . $data['module_name']
                ]
            );

            // Créer la note
            $grade = Grade::create([
                'student_id' => $user->id,
                'subject_id' => $subject->id,
                'grade' => $data['note_element'],
                'comment' => json_encode([
                    'note_ct' => $data['note_ct'],
                    'note_ex' => $data['note_ex'],
                    'professor_name' => $data['professor_name'],
                    'level' => $data['level'],
                    'coef_ct' => $data['Coef_Ct'],
                    'coef_ex' => $data['Coef_Ex']
                ])
            ]);

            $grades[] = $grade;
            Log::info('Note importée', [
                'student_code' => $data['student_code'],
                'module_code' => $data['module_code']
            ]);
        }

        fclose($handle);
        return $grades;
    }
}
