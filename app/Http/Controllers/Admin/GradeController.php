<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Services\CsvImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    protected $csvImportService;

    public function __construct(CsvImportService $csvImportService)
    {
        $this->csvImportService = $csvImportService;
    }

    protected function checkAdminRole()
    {
        if (!auth()->user()->can('admin')) {
            abort(403, 'Accès non autorisé.');
        }
    }

    public function index()
    {
        $this->checkAdminRole();
        $grades = Grade::with(['student', 'subject'])->paginate(10);
        return view('admin.grades.index', compact('grades'));
    }

    public function uploadForm()
    {
        $this->checkAdminRole();
        return view('admin.grades.upload');
    }

    public function import(Request $request)
    {
        $this->checkAdminRole();
        
        // Valider et stocker le fichier
        $validated = $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);
        $path = $request->file('file')->store('temp', 'public');

        try {
            // Démarrer une transaction pour garantir l'intégrité des données
            DB::beginTransaction();
            
            try {
                $grades = $this->csvImportService->import($path);
                DB::commit();
                Storage::delete($path);
                return redirect()->route('admin.grades.index')->with('success', 'Notes importées avec succès.');
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            Storage::delete($path);
            return redirect()->back()->with('error', 'Erreur lors de l\'importation des notes: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string',
            'type' => 'required|string|in:student,subject',
        ]);

        $query = Grade::query();

        if ($validated['search']) {
            if ($validated['type'] === 'student') {
                $query->whereHas('student', function ($query) use ($validated) {
                    $query->where('first_name', 'like', '%' . $validated['search'] . '%')
                          ->orWhere('last_name', 'like', '%' . $validated['search'] . '%')
                          ->orWhere('email', 'like', '%' . $validated['search'] . '%');
                });
            } else {
                $query->whereHas('subject', function ($query) use ($validated) {
                    $query->where('name', 'like', '%' . $validated['search'] . '%')
                          ->orWhere('description', 'like', '%' . $validated['search'] . '%');
                });
            }
        }

        $grades = $query->with(['student', 'subject'])->paginate(10);
        return view('admin.grades.index', compact('grades'));
    }
}