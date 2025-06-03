<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Grade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ImportGrades extends Command
{
    protected $signature = 'import:grades';
    protected $description = 'Import users and grades from CSV files';

    public function handle()
    {
        $this->info('Starting import process...');

        // Import module 1
        $this->importFromCSV('note_2025_module_1.csv');
        
        // Import module 2
        $this->importFromCSV('note_2025_module_2.csv');

        $this->info('Import completed successfully!');
    }

    protected function importFromCSV($filename)
    {
        if (!file_exists($filename)) {
            $this->error("File {$filename} not found!");
            return;
        }

        $this->info("Processing {$filename}...");
        
        $handle = fopen($filename, 'r');
        $header = fgetcsv($handle); // Skip header row

        DB::beginTransaction();
        try {
            while (($data = fgetcsv($handle)) !== false) {
                $row = array_combine($header, $data);
                
                // Create or update user
                $user = User::updateOrCreate(
                    ['email' => $row['student_code'] . '@supmti.com'],
                    [
                        'name' => $row['first_name'] . ' ' . $row['last_name'],
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                        'password' => Hash::make($row['student_code']),
                        'role' => 'student'
                    ]
                );

                // Create grade
                Grade::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'module_code' => $row['module_code'],
                        'module_name' => $row['module_name']
                    ],
                    [
                        'note_ct' => $row['note_ct'],
                        'note_ex' => $row['note_ex'],
                        'note_element' => $row['note_element'],
                        'professor_name' => $row['professor_name'],
                        'level' => $row['level'],
                        'coef_ct' => $row['Coef_Ct'],
                        'coef_ex' => $row['Coef_Ex']
                    ]
                );
            }

            DB::commit();
            $this->info("Successfully imported data from {$filename}");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Error importing {$filename}: " . $e->getMessage());
        }

        fclose($handle);
    }
} 